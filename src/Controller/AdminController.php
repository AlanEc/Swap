<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 03/12/2018
 * Time: 11:51
 */

declare(strict_types = 1);
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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(MessageRepository $messageRepository, UserRepository $userRepository, BookingRepository $bookingRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
            'messages' => $messageRepository->findAll(),
            'users' => $userRepository->findAll(),
        ]);
    }
}