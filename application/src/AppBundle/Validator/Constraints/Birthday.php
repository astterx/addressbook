<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Birthday extends Constraint
{
    public $message = 'Birthday cannot be greater than today';

    public function validatedBy(): string
    {
        return \get_class($this).'Validator';
    }
}
