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


/**
 * @IsGranted("ROLE_USER")
 */
class SwapServiceController extends AbstractController
{
    /**
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
     * @Route("/search/ajax_search", name="swap_ajax_search")
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
                'User' => $swap->getUser()->getFirstName(),
                'Quantity' => $swap->getQuantity(),
                'Id' => $swap->getId(),
                'City' => $swap->getCity(),
                'Category' => $swap->getSwapServiceType()->getLabel());
        }
        return new JsonResponse($swapsServicesArray);
    }

    /**
     * @Route("/search/focus/{id}", name="swap_focus")
     */
    public function booking(Request $request)
    {
        return $this->render('core/swapService/booking.html.twig');
    }

    /**
     * @Route("/swap/delete/{serviceId}", name="swap_delete")
     */
    public function delete(Request $request, $serviceId)
    {
        $repository = $this->getDoctrine()->getRepository(SwapService::class);
        $swapService = $repository->findOneBy(['id' => $serviceId]);
        $swapService->setDisabled(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($swapService);
        $em->flush();

        $this->addFlash('success', 'Swap Service Supprimé');
        return $this->redirectToRoute('swap_user');
    }
}