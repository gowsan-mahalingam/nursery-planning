<?php

namespace App\BusinessLogic\UseCases\Schedule;

use App\Adapters\Secondary\Repositories\ScheduleRepositoryInterface;
use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\Schedule;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

readonly class CreateScheduleUseCase
{
    public function __construct(private ScheduleRepositoryInterface $scheduleRepository)
    {}

    public function execute(Child $child, \DateTime $startTime, \DateTime $endTime): Schedule
    {
        $existingDailyPlaning = $this->scheduleRepository->getByDate($child, $startTime);

        if($existingDailyPlaning) {
            throw new BadRequestHttpException('A daily planning already exists for this child and date.');
        }

        $data = new Schedule($child, $startTime, $endTime);
        $this->scheduleRepository->save($data);

        return $data;
    }
}
