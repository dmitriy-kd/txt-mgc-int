<?php

namespace App\Entity;

use App\Repository\TestItemRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity(repositoryClass: TestItemRepository::class)]
class TestItem
{
    #[Id, ManyToOne(targetEntity: Question::class)]
    private Question $question;

    #[Id, ManyToOne(targetEntity: Answer::class)]
    private Answer $answer;

    #[Column]
    private bool $isRightAnswer;

    public function __construct(
        Question $question,
        Answer $answer,
        bool $isRightAnswer
    ) {
        $this->question = $question;
        $this->answer = $answer;
        $this->isRightAnswer = $isRightAnswer;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function getAnswer(): Answer
    {
        return $this->answer;
    }

    public function isRightAnswer(): bool
    {
        return $this->isRightAnswer;
    }
}