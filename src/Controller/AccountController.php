<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
    * @IsGranted("ROLE_USER")
    * @Route("/account", name="app_account")
    */
    public function index()
    {
        return $this->render('account/index.html.twig', [
        'controller_name' => 'AccountController',
        ]);
    }
}