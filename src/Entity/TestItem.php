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
    private ?Question $question = null;

    #[Id, ManyToOne(targetEntity: Answer::class)]
    private ?Answer $answer = null;

    #[Column]
    private ?bool $isRightAnswer = null;

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(Question $question): TestItem
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(Answer $answer): TestItem
    {
        $this->answer = $answer;

        return $this;
    }

    public function isRightAnswer(): ?bool
    {
        return $this->isRightAnswer;
    }

    public function setIsRightAnswer(bool $isRightAnswer): TestItem
    {
        $this->isRightAnswer = $isRightAnswer;

        return $this;
    }
}