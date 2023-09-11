<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: TestResult::class)]
class TestResult
{
    #[Id, Column, GeneratedValue]
    private ?int $id = null;

    #[OneToMany(mappedBy: 'testResult', targetEntity: TestResultItem::class)]
    private Collection $testResultItems;

    public function __construct()
    {
        $this->testResultItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestResultItems(): Collection
    {
        return $this->testResultItems;
    }

    public function addTestResultItem(TestResultItem $testResultItem): TestResult
    {
        if (!$this->testResultItems->contains($testResultItem)) {
            $this->testResultItems->add($testResultItem);
        }

        return $this;
    }
}