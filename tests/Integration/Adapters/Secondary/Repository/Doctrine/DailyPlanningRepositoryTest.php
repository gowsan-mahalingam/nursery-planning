<?php

namespace App\Tests\Integration\Adapters\Secondary\Repository\Doctrine;

use App\Adapters\Secondary\Repositories\DailyPlanningRepositoryInterface;
use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\DailyPlanning;
use App\DataFixtures\AppFixture;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DailyPlanningRepositoryTest extends KernelTestCase
{
    private $entityManager;
    private $container;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->container = $kernel->getContainer();
        $this->entityManager = $this->container->get('doctrine')->getManager();
        $connection = $this->entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeStatement($platform->getTruncateTableSQL('daily_planning', true));
    }

    #[Test]
    public function should_retrive_daily_planning_by_date(): void
    {
        $dailyPlanningRepository =  $this->container->get(DailyPlanningRepositoryInterface::class);
        $child = new Child(AppFixture::CHILD_NAME);
        $this->entityManager->persist($child);

        $newDailyPlanning = new DailyPlanning($child, new \DateTime("2024-01-01 08:00"), new \DateTime("2024-01-01 09:00"));
        $this->entityManager->persist($newDailyPlanning);
        $this->entityManager->flush();

        $dailyPlanning = $dailyPlanningRepository->getByDate($child, new \DateTime("2024-01-01 08:00"));
        $this->assertEquals($newDailyPlanning, $dailyPlanning);
    }

    #[Test]
    public function should_save_daily_planning(): void
    {
        $dailyPlanningRepository =  $this->container->get(DailyPlanningRepositoryInterface::class);

        $child = new Child(AppFixture::CHILD_NAME);
        $this->entityManager->persist($child);

        $newDailyPlanning = new DailyPlanning($child, new \DateTime("2024-01-01 08:00"), new \DateTime("2024-01-01 09:00"));
        $dailyPlanningRepository->save($newDailyPlanning);

        $dailyPlanning = $dailyPlanningRepository->getByDate($child, new \DateTime("2024-01-01 08:00"));
        $this->assertEquals($newDailyPlanning, $dailyPlanning);
    }
}
