<?php

namespace App\Adapters\Primary\Controller\Model;

use Symfony\Component\Validator\Constraints as Assert;
class PostDayPlanningDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\DateTime(format: 'Y-m-d')]
        public string $date,
        #[Assert\NotBlank]
        #[Assert\DateTime(format: 'H:i')]
        public string $startTime,
        #[Assert\NotBlank]
        #[Assert\DateTime(format: 'H:i')]
        public string $endTime
    ) {}

}
