<?php

namespace App\Form\Model;

use App\Entity\Question;

class TestModel
{
    /** @var Question[] */
    private array $questions = [];

    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function setQuestions(array $questions): TestModel
    {
        $this->questions = $questions;

        return $this;
    }
}