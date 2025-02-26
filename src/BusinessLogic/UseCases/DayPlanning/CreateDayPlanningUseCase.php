<?php

namespace App\BusinessLogic\UseCases\DayPlanning;

use App\Adapters\Secondary\Repositories\DailyPlanningRepositoryInterface;
use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\DailyPlanning;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

readonly class CreateDayPlanningUseCase
{
    public function __construct(private DailyPlanningRepositoryInterface $dailyPlanningRepository)
    {}

    public function execute(Child $child, \DateTime $startTime, \DateTime $endTime): DailyPlanning
    {
        $existingDailyPlaning = $this->dailyPlanningRepository->getByDate($child, $startTime);

        if($existingDailyPlaning) {
            throw new BadRequestHttpException('A daily planning already exists for this child and date.');
        }

        $data = new DailyPlanning($child, $startTime, $endTime);
        $this->dailyPlanningRepository->save($data);

        return $data;
    }
}
