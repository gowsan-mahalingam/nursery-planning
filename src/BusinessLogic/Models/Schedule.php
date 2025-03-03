<?php

namespace App\BusinessLogic\Models;


use App\Adapters\Secondary\Repositories\Doctrine\ScheduleRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private DateTime $startTime;

    #[ORM\Column(type: 'datetime')]
    private DateTime $endTime;

    #[ORM\ManyToOne(targetEntity: Child::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Child $child;

    public function __construct(Child $child, DateTime $startTime, DateTime $endTime)
    {
        $this->child = $child;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): DateTime
    {
        return $this->startTime;
    }

    public function getEndTime(): DateTime
    {
        return $this->endTime;
    }

    public function getChild(): Child
    {
        return $this->child;
    }

    #[Assert\Callback]
    public function validateDate(ExecutionContextInterface $context) :void
    {
        if ($this->startTime->format('Y-m-d') !== $this->endTime->format('Y-m-d')) {
            $context->buildViolation('Start time and end time must be the same date')
                ->atPath('startTime')
                ->addViolation();
        }

        if ($this->startTime >= $this->endTime) {
            $context->buildViolation('Start time must be before end time')
                ->atPath('startTime')
                ->addViolation();
        }
    }
}
