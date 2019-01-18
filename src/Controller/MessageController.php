<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 08/01/2019
 * Time: 13:53
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MessageFormType;
use App\Entity\Message;
use App\Entity\SwapService;
use App\Entity\User;
use App\Service\MessageManager;

class MessageController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/mailbox", name="app_message_mailBox")
     */
    public function mailBox()
    {
        $userId = $this->getUser()->getId();

        $repository = $this->getDoctrine()->getRepository(Message::class);
        $messages = $repository->getMessagesByUser($userId);

        return $this->render('core/message/mailBox.html.twig', [
            'messages' => $messages,
            'idUser' => $userId,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/message/{serviceId}", name="app_message_send")
     */
    public function send(Request $request, $serviceId, MessageManager $messageManager)
    {
        $form = $this->createForm(MessageFormType::class);
        $form->handleRequest($request);

        $user = $this->getUser();

        $repository = $this->getDoctrine()->getRepository(SwapService::class);
        $service = $repository->findOneBy(array('id' => $serviceId));
        $repository = $this->getDoctrine()->getRepository(User::class);
        $userReceiver = $repository->findOneBy(array('id' => $service->getUser()));

        if ($form->isSubmitted() && $form->isValid()) {
            $message  = $form->getData();
            $message->setUserSender($user);
            $message->setServiceId(756);
            $message->setServiceId($serviceId);
            $message->setUserReceiver($userReceiver);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
        }

        $messages = $this->getDoctrine()
            ->getRepository(Message::class)
            ->conversationRecovery($serviceId, $user->getId());

        return $this->render('core/Message/conversation.html.twig', array(
            'listMessage' => $messages,
            'service' => $service,
            'userId' => $user->getId(),
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/message/{id}", name="app_message_read")
     */
    public function read($id)
    {
        return $this->render('core/message/message.html.twig');
    }
}


