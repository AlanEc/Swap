<?php

namespace App\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface ;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniqueEmailValidator extends ConstraintValidator
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        $repository = $this->em->getRepository(User::class);
        $advertiser  = $repository->findBy(['email' => $value]);

        if ($advertiser) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}