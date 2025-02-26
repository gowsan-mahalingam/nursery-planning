<?php

namespace App\Tests\Unit\BusinessLogic\UseCases\DayPlanning;

use App\Adapters\Secondary\Repositories\Fake\FakeDailyPlanningRepository;
use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\DailyPlanning;
use App\BusinessLogic\UseCases\DayPlanning\CreateDayPlanningUseCase;
use DateTime;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class createDayPlanningTest extends TestCase
{
    #[Test]
    public function day_planning_should_be_the_same_date(): void
    {

        $startTime = new DateTime("2024-01-01 08:00");
        $endTime = new DateTime("2024-01-02 08:00");
        $child = new Child('John Doe');
        $this->assertExpectException($child, $startTime, $endTime);
    }

    #[Test]
    public function end_time_must_not_be_either_than_start_time(): void
    {
        $startTime = new DateTime("2024-01-01 08:00");
        $endTime = new DateTime("2024-01-01 07:00");
        $child = new Child('John Doe');
        $this->assertExpectException($child, $startTime, $endTime);
    }
    #[Test]
    public function end_time_must_not_be_equal_to_start_time(): void
    {
        $startTime = new DateTime("2024-01-01 08:00");
        $endTime = new DateTime("2024-01-01 08:00");
        $child = new Child('John Doe');
        $this->assertExpectException($child, $startTime, $endTime);
    }

    #[Test]
    public function do_not_create_day_planning_if_one_already_exists(): void
    {
        $startTime = new DateTime("2024-01-01 08:00");
        $endTime = new DateTime("2024-01-01 09:00");
        $child = new Child('John Doe');
        $this->assertExpectException($child, $startTime, $endTime);
    }


    private function assertExpectException(Child $child, DateTime $startTime, DateTime $endTime): void
    {
        $dailyPlanning = new FakeDailyPlanningRepository();
        $dailyPlanning->dailyPlannings[$startTime->format('Y-m-d')] = new DailyPlanning($child, $startTime, $endTime);

        $createDayPlanningUseCase = new CreateDayPlanningUseCase($dailyPlanning);
        $this->expectException(Exception::class);
        $createDayPlanningUseCase->execute($child, $startTime, $endTime);
    }
}
