<?php

namespace App\Adapters\Secondary\Repositories;

use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\Schedule;

interface ScheduleRepositoryInterface
{
    public function getByDate(Child $child, \DateTime $date): ?Schedule;

    public function save(Schedule $dailyPanning): void;

}
