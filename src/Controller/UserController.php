<?php

declare(strict_types = 1);
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;
use App\Form\UserFormType;

class UserController extends AbstractController
{
    /**
     * @Route("/index", name="app_profile")
     */
    public function index(TranslatorInterface $translator)
    {

    	$form = $this->createForm(UserFormType::class);

        return $this->render('core/user/profile.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="new_profile")
     */
    public function new(TranslatorInterface $translator)
    {
        
    }

    /**
     * @Route("/", name="update_profile")
     */
    public function update(TranslatorInterface $translator)
    {
       
    }
}
