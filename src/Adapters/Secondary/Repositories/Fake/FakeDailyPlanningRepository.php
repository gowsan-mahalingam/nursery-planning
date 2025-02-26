<?php

namespace App\Adapters\Secondary\Repositories\Fake;

use App\Adapters\Secondary\Repositories\DailyPlanningRepositoryInterface;
use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\DailyPlanning;

class FakeDailyPlanningRepository  implements DailyPlanningRepositoryInterface
{

    public array $dailyPlannings = [];
    public function getByDate(Child $child, \DateTime $date): ?DailyPlanning
    {
        foreach ($this->dailyPlannings as $dailyPlanning) {
            if ($dailyPlanning->getStartTime()->format('Y-m-d') === $date->format('Y-m-d') && $dailyPlanning->getChild() === $child) {
                return $dailyPlanning;
            }
        }
        return null;
    }

    public function save(DailyPlanning $dailyPanning): void
    {
        $this->dailyPlannings[$dailyPanning->getStartTime()->format('Y-m-d')] = $dailyPanning;
    }
}
