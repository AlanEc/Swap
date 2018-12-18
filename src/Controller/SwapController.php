<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 18/12/2018
 * Time: 11:16
 */

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SwapController extends AbstractController
{
    /**
     * @Route("/mySwaps", name="swap_user")
     */
    public function swapsServiceByUser()
    {
        $user = $this->getUser();
        return $this->render('core/mySwapsServices.html.twig', array(
            'user' => $user,
            'services' => $user->getSwapServices(),
        ));
    }
}