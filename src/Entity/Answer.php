<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\UniqueConstraint;

#[Entity(repositoryClass: AnswerRepository::class)]
#[UniqueConstraint(name: 'idx_uniq_answer_text', columns: ['text'])]
class Answer
{
    #[Id, Column, GeneratedValue]
    private ?int $id = null;

    #[Column(length: 255)]
    private ?string $text = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Answer
    {
        $this->text = $text;

        return $this;
    }
}