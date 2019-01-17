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
    public function new($swapId, $booking) {

        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(SwapService::class);
        $swap = $repository->findOneBy(['id' => $swapId]);

        $swapServiceType = $swap->getSwapServiceType()->getLabel();
        $totalAmount = $this->calculTotalAmount($booking, $swapServiceType);
        $checkAccount = $this->checkAccount($user, $totalAmount);

        if ($checkAccount == true ) {
            $transaction = new Transaction();
            $transaction->setAmount($totalAmount);
            $transaction->setUserSender($this->getUser());
            $transaction->setUserReceiver($swap->getUser());
            $transaction->setSwapService($swap);
            $em = $this->getDoctrine()->getManager();
            $em->persist($transaction);
            $em->flush();
        } else {
            return false;
        }

        return true;
    }

    public function calculTotalAmount($booking, $swapServiceType) {
        $datetime1 = date_create($booking->getDateStart()->format('Y-m-d'));
        $datetime2 = date_create($booking->getDateEnd()->format('Y-m-d'));
        $interval = date_diff($datetime1, $datetime2);
        $days =  $interval->d ;
        $amountType = $swapServiceType->valueScale();
        $totalAmount = $days * $amountType;

        return $totalAmount;
    }

    public function checkAccount($user, $amount) {
        if ($user->getAccount() >= $amount) {
            $this->debit($user, $amount);
            return true;
        } else {
            return false;
        }
    }

    public function debit($user, $amount) {
        $newTotalAccount = $user->getAccount() - $amount;
        $user->setAccount($newTotalAccount);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
    }

    public function credit() {

    }
}