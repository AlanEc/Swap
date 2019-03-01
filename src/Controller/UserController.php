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
use App\Form\ImageFormType;
use App\Entity\Image;
use App\Service\FileUploader;
use App\Service\ImageOptimizer;

/**
 * @IsGranted("ROLE_USER")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(ObjectManager $em, Request $request, UserPasswordEncoderInterface $passwordEncoder, ImageOptimizer $imageOptimizer, FileUploader $fileUploader)
    {
        $user = $this->getUser();
        $form = $this->createForm(ImageFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $file = $data->getImage();

            if ($data !== null) {
                $data->upload();
                $fileName = $data->getImage();
                $resize =  $imageOptimizer->resize($fileName);
            }
            $image = new Image();
            $image->setImage($data->getImage());
            //$user->setImage($file);
            //$em->persist($data);
            $user->setImage($image);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'User updated!');
            return $this->redirectToRoute('app_account');
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
