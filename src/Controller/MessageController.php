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

        return $this->render('core/message/mailBox.html.twig', [
            'listMessage' => $listMessage,
            'userId' => userId,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/message/{id}", name="app_message_send")
     */
    public function send($id)
    {
        return $this->render('core/message/message.html.twig');
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