<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAnswerRepository")
 */
class UserAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Question", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $answerText;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AnswerItem")
     */
    private $answer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userAnswers")
     */
    private $user;

    public function __construct()
    {
        $this->answer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAnswer(): ?AnswerItem
    {
        return $this->answer;
    }

    public function setAnswer(?AnswerItem $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getAnswerText(): ?string
    {
        return $this->answerText;
    }

    public function setAnswerText(?string $answerText): self
    {
        $this->answerText = $answerText;

        return $this;
    }

    public function addAnswer(AnswerItem $answer): self
    {
        if (!$this->answer->contains($answer)) {
            $this->answer[] = $answer;
        }

        return $this;
    }

    public function removeAnswer(AnswerItem $answer): self
    {
        if ($this->answer->contains($answer)) {
            $this->answer->removeElement($answer);
        }

        return $this;
    }
}