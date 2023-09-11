<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\UniqueConstraint;

#[Entity(repositoryClass: QuestionRepository::class)]
#[UniqueConstraint(name: 'idx_uniq_question_text', columns: ['text'])]
class Question
{
    #[Id, Column, GeneratedValue]
    private ?int $id = null;

    #[OneToMany(mappedBy: 'question', targetEntity: TestItem::class)]
    private Collection $testItems;

    #[Column(length: 255)]
    private ?string $text = null;

    public function __construct()
    {
        $this->testItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): Question
    {
        $this->text = $text;

        return $this;
    }

    public function getTestItems(): Collection
    {
        return $this->testItems;
    }

    public function setTestItems(array $testItems): Question
    {
        $this->testItems = new ArrayCollection($testItems);

        return $this;
    }
}