<?php

namespace App\Tests\Integration\Adapters\Secondary\Repository\Doctrine;

use App\Adapters\Secondary\Repositories\DailyPlanningRepositoryInterface;
use App\BusinessLogic\Models\DailyPlanning;
use App\Tests\Factory\ChildFactory;
use App\Tests\Factory\DailyPlanningFactory;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;

class DailyPlanningRepositoryTest extends KernelTestCase
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
        $dailyPlanningRepository =  $this->container->get(DailyPlanningRepositoryInterface::class);

        /** @var DailyPlanning $newDailyPlanning */
        $newDailyPlanning = DailyPlanningFactory::createOne([
            'startTime' => new \DateTime("2024-01-01 08:00"),
            'endTime' => new \DateTime("2024-01-01 09:00"),
        ]);

        $dailyPlanning = $dailyPlanningRepository->getByDate($newDailyPlanning->getChild(), new \DateTime("2024-01-01 08:00"));

        $this->assertEquals($newDailyPlanning->getId(), $dailyPlanning->getId());
        $this->assertEquals($newDailyPlanning->getChild(), $dailyPlanning->getChild());
    }

    #[Test]
    public function should_save_daily_planning(): void
    {
        $child = ChildFactory::createOne()->_real();

        $newDailyPlanning = new DailyPlanning($child, new \DateTime("2024-01-01 08:00"), new \DateTime("2024-01-01 09:00"));

        $dailyPlanningRepository =  $this->container->get(DailyPlanningRepositoryInterface::class);
        $dailyPlanningRepository->save($newDailyPlanning);

        $dailyPlanning = $dailyPlanningRepository->getByDate($child, new \DateTime("2024-01-01 08:00"));
        $this->assertEquals($newDailyPlanning, $dailyPlanning);
    }
}
