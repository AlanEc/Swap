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

/**
 * @IsGranted("ROLE_USER")
 */
class MessageController extends AbstractController
{
    /**
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
     * @Route("/message/{serviceId}/{receiverId}", name="app_message_send")
     */
    public function send(Request $request, $serviceId, $receiverId, MessageManager $messageManager)
    {
        $form = $this->createForm(MessageFormType::class);
        $form->handleRequest($request);

        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(SwapService::class);
        $service = $repository->findOneBy(array('id' => $serviceId));
        $repository = $this->getDoctrine()->getRepository(User::class);
        $userReceiver = $repository->findOneBy(array('id' => $receiverId));

        if ($form->isSubmitted() && $form->isValid()) {
            $message  = $form->getData();
            $message->setUserSender($user);
            $message->setServiceId($serviceId);
            $message->setUserReceiver($userReceiver);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
        }

        $messages = $this->getDoctrine()
            ->getRepository(Message::class)
            ->conversationRecovery($serviceId, $user->getId(), $receiverId);

        return $this->render('core/message/conversation.html.twig', array(
            'listMessage' => $messages,
            'service' => $service,
            'userId' => $user->getId(),
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/message/{id}", name="app_message_read")
     */
    public function read($id)
    {
        return $this->render('core/message/message.html.twig');
    }
}


