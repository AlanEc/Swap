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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class SwapServiceController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add", name="swap_add")
     */
    public function addSwapAction(Request $request)
    {
        $swapService = new SwapService();
        $form = $this->createForm(SwapServiceFormType::class, $swapService);

        $form = $this->container->get('Swap_form.FormCreator');
        $creationForm = $form->creation($formBuilder, $request, $service);

        if ($formBuilder->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('swap_ajouter_service_details', array(
                'id' => $service->getId()
            )); }

        return $this->render('SwapPlatformBundle:Service:ajouterSwap.html.twig', array(
            'form' => $formBuilder->createView(),
        ));
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
     * @Route("/search", name="swap_search")
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