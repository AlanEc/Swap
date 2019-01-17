<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 16/01/2019
 * Time: 10:08
 */

namespace App\Service;

use App\Entity\BookingState;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MessageManager extends AbstractController
{
    public function persist() {
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
        }
    }
}