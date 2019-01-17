<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 17/01/2019
 * Time: 09:51
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    public function setDebit(ObjectManager $em, Request $request) {

    }

    public function setCredit(ObjectManager $em, Request $request) {

    }
}