<?php

namespace App\Adapters\Secondary\Repositories\Fake;

use App\Adapters\Secondary\Repositories\ScheduleRepositoryInterface;
use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\Schedule;

class FakeScheduleRepository  implements ScheduleRepositoryInterface
{

    public array $schedules = [];
    public function getByDate(Child $child, \DateTime $date): ?Schedule
    {
        foreach ($this->schedules as $schedule) {
            if ($schedule->getStartTime()->format('Y-m-d') === $date->format('Y-m-d') && $schedule->getChild() === $child) {
                return $schedule;
            }
        }
        return null;
    }

    public function save(Schedule $dailyPanning): void
    {
        $this->schedules[$dailyPanning->getStartTime()->format('Y-m-d')] = $dailyPanning;
    }
}
