<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 11/01/2019
 * Time: 10:36
 */

namespace App\Service;

use App\Entity\SwapService;
use App\Entity\SwapServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntityFactory extends AbstractController
{
    public function create(string $source): object
    {
        if ($source == 'SwapServiceType') {
            $entity = new SwapServiceType();
            $entity->setDisabled(0);
            $entity->setCreatedAt(new \Datetime());
            $entity->setUpdatedAt(new \Datetime());
        }

        if ($source == 'SwapService') {
            $user = $this->getUser();
            $entity = new SwapService();
            $entity->setDisabled(0);
            $entity->setCreatedAt(new \Datetime());
            $entity->setUpdatedAt(new \Datetime());
            $entity->setUser($user);
        }

        return $entity;
    }

    public function persist(object $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
    }
}