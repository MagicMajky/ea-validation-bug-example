<?php

namespace App\Validator;

use App\Entity\Email;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ValidEmailValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidEmail) {
            throw new UnexpectedTypeException($constraint, ValidEmail::class);
        }
        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof Email) {
            throw new UnexpectedValueException($value, Email::class);
        }
        // assert that there is at least one @ in the string

        if (!str_contains($value->getEmail(), '@')) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ email }}', $value)
                ->atPath('email')
                ->addViolation();
        }
    }
}