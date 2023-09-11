<?php

namespace App\Validator\Constraint;

use App\Entity\Question;
use App\Form\Model\TestModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AllTestQuestionsSubmittedConstraintValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        /** @var TestModel $testModel */
        $testModel = $value;

        foreach ($testModel->getQuestions() as $question) {
            if (count($question->getTestItems()) < 1) {
                $this->context->addViolation('You did not answer on all questions');

                return;
            }
        }
    }
}