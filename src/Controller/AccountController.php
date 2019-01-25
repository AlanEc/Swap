<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{
    /**
    * @Route("/account", name="app_account")
    */
    public function index()
    {
        $user = $this->getUser(); 
        $date = new \Datetime();
        
        return $this->render('core/dashboard/dashboard.html.twig', [
        'controller_name' => 'AccountController',
        'user' => $user,
        'bookingsDone' => $user->getBookings(),
        'swapServices' => $user->getSwapServices(),
        'date' => $date
        ]);
    }
}