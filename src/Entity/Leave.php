<?php

namespace App\Entity;

use App\Repository\LeaveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeaveRepository::class)
 * @ORM\Table(name="leave_tab")
 */
class Leave
{
    const STATUS = [
        1 => 'demande en attente',
        2 => 'approuvé',
        3 => 'refusé'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private ?\DateTimeInterface $startAt;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private ?\DateTimeInterface $endAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $commentMessage;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $currentStatus;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="leaves")
     */
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getCommentMessage(): ?string
    {
        return $this->commentMessage;
    }

    public function setCommentMessage(?string $commentMessage): self
    {
        $this->commentMessage = $commentMessage;

        return $this;
    }

    public function getCurrentStatus(): ?string
    {
        return $this->currentStatus;
    }

    public function setCurrentStatus(string $currentStatus): self
    {
        $this->currentStatus = $currentStatus;

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
}
