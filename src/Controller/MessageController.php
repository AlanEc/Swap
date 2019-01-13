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
            'listMessage' => $messages,
            'idUser' => $userId,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/message/{idMessage}/{recipientId}", name="app_message_send")
     */
    public function send(Request $request, $idMessage, $recipientId)
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class);
        $form->handleRequest($request);

        $user = $this->getUser();

        $repository = $this->getDoctrine()->getRepository(Message::class);

        $listMessage = $repository->findBy(
            array('parentId' => $idMessage));

        $messageParent = $repository->findOneBy(
            array('id' => $idMessage));

        $recipientMessageParent = $messageParent->getRecipient();
        $repository = $this->getDoctrine()->getRepository(SwapService::class);

        $service = $repository->findOneBy(
            array('id' => $serviceId));

        if ($formBuilder->isValid()) {

            $repository = $repositoryService->get('SwapUserBundle:User');

            if ($user == $recipientMessageParent ) {
                $recipient = $repository->findOneBy(
                    array('id' => $message->getRecipient()));

                $message->setAuthor($user);
                $message->setServiceId(756);
                $message->setParentId($idMessage);
                $message->setServiceId($serviceId);
                $message->setRecipient($messageParent->getAuthor());
                $em = $this->getDoctrine()->getManager();
                $em->persist($message);
                $em->flush();

            } else {

                $recipient = $repository->findOneBy(
                    array('id' => $recipientMessageParent));

                $message->setUserSender($user);
                $message->setParentId($idMessage);
                $message->setServiceId($serviceId);
                $message->setUserReceiver($recipient);
                $em = $this->getDoctrine()->getManager();
                $em->persist($message);
                $em->flush();
            }}

        return $this->render('SwapPlatformBundle:Message:conversation.html.twig', array(
            'listMessage' => $listMessage,
            'messageParent' => $messageParent,
            'service' => $service,
            'userId' => $user->getId(),
            'form' => $formBuilder->createView(),
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


