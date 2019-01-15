<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\CrudMessageType;
use App\Repository\MessageRepository;

use App\Entity\User;
use App\Form\CrudUserType;
use App\Repository\UserRepository;

use App\Entity\Booking;
use App\Form\CrudBookingType;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminMessageCrudController extends AbstractController
{
    /**
     * @Route("/message", name="message_index", methods={"GET"})
     */
    public function index(MessageRepository $messageRepository, UserRepository $userRepository, BookingRepository $bookingRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
            'messages' => $messageRepository->findAll(),
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/message/new", name="message_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(CrudMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('admin/message/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/message/{id}", name="message_show", methods={"GET"})
     */
    public function show(Message $message): Response
    {
        return $this->render('admin/message/show.html.twig', [
            'message' => $message,
        ]);
    }

    /**
     * @Route("/message/{id}/edit", name="message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Message $message): Response
    {
        $form = $this->createForm(CrudMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_index', [
                'id' => $message->getId(),
            ]);
        }

        return $this->render('admin/message/edit.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/message/{id}", name="message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('message_index');
    }
}
