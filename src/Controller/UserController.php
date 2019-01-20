<?php

declare(strict_types = 1);
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserFormType;
use App\Service\FileUploader;
use App\Service\ImageOptimizer;

class UserController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/profile", name="app_profile")
     */
    public function index(ObjectManager $em, Request $request, UserPasswordEncoderInterface $passwordEncoder, ImageOptimizer $imageOptimizer, FileUploader $fileUploader)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $file = $data->getImage();
            if ($file !== null) {
                $fileName = $fileUploader->upload($file);
                $resize =  $imageOptimizer->resize($fileName);
            }
            $data->setImage($fileName);;
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'User updated!');
        }

        return $this->render('core/user/profile.html.twig', [
            'userForm' => $form->createView(),
            'user' => $user,
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
