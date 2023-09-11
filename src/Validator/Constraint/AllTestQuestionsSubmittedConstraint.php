<?php

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

class AllTestQuestionsSubmittedConstraint extends Constraint
{
    public function getTargets()
    {
        return parent::CLASS_CONSTRAINT;
    }
}