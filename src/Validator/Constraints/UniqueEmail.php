<?php
/**
 * Created by PhpStorm.
 * User: annes
 * Date: 22/01/2019
 * Time: 12:40
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    public $message = 'The Email already exists.';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
}