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
use App\Entity\SwapService;
use App\Entity\SwapServiceType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Form\SwapServiceTypeFormType;
use App\Form\SwapServiceFormType;
use App\Service\EntityFactory;

class SwapServiceController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/create", name="swap_create")
     */
    public function create(Request $request, EntityFactory $entityFactory)
    {
        $form = $this->createForm(SwapServiceTypeFormType::class);
        $form->handleRequest($request);
        $session = new Session();

        if (!isset($swapService)) {
            $swapService = $entityFactory->create('SwapService');
            $formDetails = $this->createForm(SwapServiceFormType::class, $swapService);
            $formDetails->handleRequest($request);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('swapServiceType', $form->getData());
            return $this->render('core/swapService/formDetailsSwapService.html.twig', [
                'form' => $formDetails->createView(),
                'swapService' => $swapService,
            ]);
        }

        if ($formDetails->isSubmitted() && $formDetails->isValid()) {
            $swapServiceType = $session->get('swapServiceType');
            $repository = $this->getDoctrine()->getRepository(SwapServiceType::class);
            $swapServiceType = $repository->findOneBy(['label' => $swapServiceType['label']]);
            $swapService->setSwapServiceType($swapServiceType);
            $entityFactory->persist($swapService);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_account');
        }

        return $this->render('core/swapService/formSwapService.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mySwaps", name="swap_user")
     */
    public function byUser()
    {
        $user = $this->getUser();
        return $this->render('core/swapService/mySwapsServices.html.twig', array(
            'user' => $user,
            'services' => $user->getSwapServices(),
        ));
    }

    /**
     * @Route("/search/", name="swap_search")
     */
    public function search()
    {
        $user = $this->getUser();
        return $this->render('core/swapService/search.html.twig', array(
            'user' => $user,
            'services' => $user->getSwapServices(),
        ));
    }

    /**
     * @Route("/ajax_search", name="swap_ajax_search")
     */
    public function ajax(Request $request)
    {
        $output[] = $_POST;

        $listSwapsServices = $this->getDoctrine()
            ->getRepository(SwapService::class)
            ->swapsByCoord($output[0]);

        foreach ($listSwapsServices as $swap) {
            $swapsServicesArray[] = array('Latitude' => $swap->getLatitude(),
                'Longitude' => $swap->getLongitude(),
                'People_quantity' => $swap->getPeopleQuantity(),
                'User' => $swap->getUser()->getUsername(),
                'Id' => $swap->getId(),
                'City' => $swap->getCity(),
                'Category' => $swap->getSwapServiceType()->getLabel());
        }
        return new JsonResponse($swapsServicesArray);
    }

    /**
     * @Route("/booking", name="swap_booking")
     */
    public function booking(Request $request)
    {
        return $this->render('core/swapService/booking.html.twig');
    }
}