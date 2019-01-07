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
            $swapsServicesArray[] = array('Latitude' => $swap->getLatitude(), 'Longitude' => $swap->getLongitude());
        }
        return new JsonResponse($swapsServicesArray);
    }
}