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

#[Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[Id, Column, GeneratedValue]
    private ?int $id = null;

    #[OneToMany(mappedBy: 'question', targetEntity: TestItem::class)]
    private Collection $testItems;

    #[Column(length: 255)]
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->testItems = new ArrayCollection();
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getTestItems(): ArrayCollection
    {
        return $this->testItems;
    }
}