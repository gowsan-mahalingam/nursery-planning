<?php

namespace App\Adapters\Secondary\Repositories\Doctrine;

use App\Adapters\Secondary\Repositories\DailyPlanningRepositoryInterface;
use App\BusinessLogic\Models\DailyPlanning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\BusinessLogic\Models\Child;

class DailyPlanningRepository extends ServiceEntityRepository implements DailyPlanningRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DailyPlanning::class);
    }

    public function getByDate(Child $child, \DateTime $date): ?DailyPlanning
    {
        $qb = $this->createQueryBuilder('dp')
            ->where('dp.child = :child')
            ->andWhere('dp.startTime BETWEEN :startOfDay AND :endOfDay')
                ->setParameter('startOfDay', $date->format('Y-m-d 00:00:00'))
                ->setParameter('endOfDay', $date->format('Y-m-d 23:59:59'))
            ->setParameter('child', $child);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function save(DailyPlanning $dailyPanning): void
    {
        $this->getEntityManager()->persist($dailyPanning);
        $this->getEntityManager()->flush();
    }
}
