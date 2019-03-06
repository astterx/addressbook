<?php

namespace AppBundle\Validator\Constraints;


use Carbon\Carbon;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class BirthdayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Birthday) {
            throw new UnexpectedTypeException($constraint, Birthday::class);
        }

        if (null === $value || '' === $value || !$value instanceof \DateTime) {
            return;
        }

        $birthday = new Carbon($value->format('Y-m-d'));
        $now = new Carbon();

        if ($now->lt($birthday)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
