<?php

namespace App\Adapters\Secondary\Repositories;

use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\DailyPlanning;

interface DailyPlanningRepositoryInterface
{
    public function getByDate(Child $child, \DateTime $date): ?DailyPlanning;

    public function save(DailyPlanning $dailyPanning): void;

}
