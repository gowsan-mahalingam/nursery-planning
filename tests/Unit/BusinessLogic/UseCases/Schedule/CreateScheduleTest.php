<?php

namespace App\Tests\Unit\BusinessLogic\UseCases\Schedule;

use App\Adapters\Secondary\Repositories\Fake\FakeScheduleRepository;
use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\Parents;
use App\BusinessLogic\Models\Schedule;
use App\BusinessLogic\UseCases\Schedule\CreateScheduleUseCase;
use DateTime;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CreateScheduleTest extends TestCase
{
    #[Test]
    public function schedule_should_be_the_same_date(): void
    {

        $startTime = new DateTime("2024-01-01 08:00");
        $endTime = new DateTime("2024-01-02 08:00");
        $child = $this->createChildWithParent();
        $this->assertExpectException($child, $startTime, $endTime);
    }

    #[Test]
    public function end_time_must_not_be_either_than_start_time(): void
    {
        $startTime = new DateTime("2024-01-01 08:00");
        $endTime = new DateTime("2024-01-01 07:00");
        $child = $this->createChildWithParent();
        $this->assertExpectException($child, $startTime, $endTime);
    }
    #[Test]
    public function end_time_must_not_be_equal_to_start_time(): void
    {
        $startTime = new DateTime("2024-01-01 08:00");
        $endTime = new DateTime("2024-01-01 08:00");
        $child = $this->createChildWithParent();
        $this->assertExpectException($child, $startTime, $endTime);
    }

    #[Test]
    public function do_not_create_schedule_if_one_already_exists(): void
    {
        $startTime = new DateTime("2024-01-01 08:00");
        $endTime = new DateTime("2024-01-01 09:00");
        $child = $this->createChildWithParent();
        $this->assertExpectException($child, $startTime, $endTime);
    }


    private function assertExpectException(Child $child, DateTime $startTime, DateTime $endTime): void
    {
        $scheduleRepository = new FakeScheduleRepository();
        $scheduleRepository->schedules[$startTime->format('Y-m-d')] = new Schedule($child, $startTime, $endTime);

        $createDayPlanningUseCase = new CreateScheduleUseCase($scheduleRepository);
        $this->expectException(Exception::class);
        $createDayPlanningUseCase->execute($child, $startTime, $endTime);
    }

    private function createChildWithParent(): Child
    {
        $parent = new Parents('parent@email.com', 'password');
        $child = new Child('John Doe', $parent);

        return $child;
    }
}
