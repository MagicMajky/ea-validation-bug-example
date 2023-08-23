<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ValidEmail extends Constraint
{
    public string $message = 'The email {{ email }} is not a valid email.';

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }

    public function validatedBy(): string
    {
        return ValidEmailValidator::class;
    }
}