<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 17/01/2019
 * Time: 10:13
 */

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Transaction;
use App\Entity\SwapService;

class TransactionManager extends AbstractController
{
    public function new($swap, $totalAmount) {

        $transaction = new Transaction();
        $transaction->setAmount($totalAmount);
        $transaction->setUserSender($this->getUser());
        $transaction->setUserReceiver($swap->getUser());
        $transaction->setSwapService($swap);
        $this->getDoctrine()->getManager();
        $em->persist($transaction);
        $em->flush();

        return $transaction;
    }

    public function calculTotalAmount($booking, $swap) {
        $datetime1 = date_create($booking->getDateStart()->format('Y-m-d'));
        $datetime2 = date_create($booking->getDateEnd()->format('Y-m-d'));
        $interval = date_diff($datetime1, $datetime2);
        $days =  $interval->d ;
        $amountType = $swap->getSwapServiceType()->getValueScale();
        $totalAmount = $days * $amountType;

        return $totalAmount;
    }

    public function checkAccount($amount) {
        if ($this->getUser()->getAccount() >= $amount) {
            $this->debit($amount);
            return true;
        } else {
            return false;
        }
    }

    public function debit($amount) {
        $user = $this->getUser();
        $newTotalAccount = $user->getAccount() - $amount;
        $user->setAccount($newTotalAccount);
        $this->em->persist($user);
        $this->em->flush();
    }

    public function credit($booking) {
        $user = $booking->getTransaction()->getUserReceiver();
        $transaction = $booking->getTransaction();
        $amount = $transaction->getAmount();
        $newTotalAccount = $user->getAccount() + $amount;
        $user->setAccount($newTotalAccount);
        $this->em->persist($user, $transaction);
        $this->em->flush();
    }

    public function canceled($booking, $bookingState) {
        $userSender = $booking->getTransaction()->getUserSender();
        $transaction = $booking->getTransaction();
        $amount = $transaction->getAmount();
        $newTotalAccount = $userSender->getAccount() + $amount;
        $userSender->setAccount($newTotalAccount);
        $this->em->persist($userSender);

        if ($bookingState->getLabel() == 'Accepted') {
            $userReceiver = $booking->getTransaction()->getUserReceiver();
            $newTotalAccount = $userReceiver->getAccount() - $amount;
            $userReceiver->setAccount($newTotalAccount);
            $this->em->persist($userReceiver);
        }
        $em->flush();
    }
}
