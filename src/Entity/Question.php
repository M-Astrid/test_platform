<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Test", inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $test;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AnswerItem", mappedBy="question", orphanRemoval=true)
     */
    private $answerItems;

    public function __construct()
    {
        $this->answerItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getType(): ?QuestionType
    {
        return $this->type;
    }

    public function setType(?QuestionType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|AnswerItem[]
     */
    public function getAnswerItems(): Collection
    {
        return $this->answerItems;
    }

    public function addAnswerItem(AnswerItem $answerItem): self
    {
        if (!$this->answerItems->contains($answerItem)) {
            $this->answerItems[] = $answerItem;
            $answerItem->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswerItem(AnswerItem $answerItem): self
    {
        if ($this->answerItems->contains($answerItem)) {
            $this->answerItems->removeElement($answerItem);
            // set the owning side to null (unless already changed)
            if ($answerItem->getQuestion() === $this) {
                $answerItem->setQuestion(null);
            }
        }

        return $this;
    }
}
