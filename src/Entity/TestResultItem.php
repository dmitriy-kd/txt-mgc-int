<?php

namespace App\Entity;

use App\Repository\TestResultItemRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity(repositoryClass: TestResultItemRepository::class)]
class TestResultItem
{
    #[Id, Column, GeneratedValue]
    private ?int $id = null;

    #[ManyToOne(targetEntity: Question::class)]
    private Question $question;

    #[ManyToOne(targetEntity: Answer::class)]
    private Answer $answer;

    #[ManyToOne(targetEntity: TestResult::class, inversedBy: 'testResultItems')]
    private TestResult $testResult;

    #[Column]
    private bool $isRightAnswer;

    public function __construct(
        TestResult $testResult,
        Question $question,
        Answer $answer,
        bool $isRightAnswer
    ) {
        $this->testResult = $testResult;
        $this->question = $question;
        $this->answer = $answer;
        $this->isRightAnswer = $isRightAnswer;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTestResult(): TestResult
    {
        return $this->testResult;
    }
}