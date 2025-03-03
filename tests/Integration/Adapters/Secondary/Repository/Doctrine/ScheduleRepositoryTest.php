<?php

namespace App\Tests\Integration\Adapters\Secondary\Repository\Doctrine;

use App\Adapters\Secondary\Repositories\ScheduleRepositoryInterface;
use App\BusinessLogic\Models\Schedule;
use App\Tests\Factory\ChildFactory;
use App\Tests\Factory\ScheduleFactory;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;

class ScheduleRepositoryTest extends KernelTestCase
{
    use Factories;
    private $entityManager;
    private $container;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->container = $kernel->getContainer();
        $this->entityManager = $this->container->get('doctrine')->getManager();
    }

    #[Test]
    public function should_retrive_daily_planning_by_date(): void
    {
        $scheduleRepository =  $this->container->get(ScheduleRepositoryInterface::class);

        /** @var Schedule $newSchedule */
        $newSchedule = ScheduleFactory::createOne([
            'startTime' => new \DateTime("2024-01-01 08:00"),
            'endTime' => new \DateTime("2024-01-01 09:00"),
        ]);

        $schedule = $scheduleRepository->getByDate($newSchedule->getChild(), new \DateTime("2024-01-01 08:00"));

        $this->assertEquals($newSchedule->getId(), $schedule->getId());
        $this->assertEquals($newSchedule->getChild(), $schedule->getChild());
    }

    #[Test]
    public function should_save_daily_planning(): void
    {
        $child = ChildFactory::createOne()->_real();

        $newSchedule = new Schedule($child, new \DateTime("2024-01-01 08:00"), new \DateTime("2024-01-01 09:00"));

        $scheduleRepository =  $this->container->get(ScheduleRepositoryInterface::class);
        $scheduleRepository->save($newSchedule);

        $schedule = $scheduleRepository->getByDate($child, new \DateTime("2024-01-01 08:00"));
        $this->assertEquals($newSchedule, $schedule);
    }
}
