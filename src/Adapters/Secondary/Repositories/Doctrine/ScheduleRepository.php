<?php

namespace App\Adapters\Secondary\Repositories\Doctrine;

use App\Adapters\Secondary\Repositories\ScheduleRepositoryInterface;
use App\BusinessLogic\Models\Child;
use App\BusinessLogic\Models\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ScheduleRepository extends ServiceEntityRepository implements ScheduleRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Schedule::class);
    }

    public function getByDate(Child $child, \DateTime $date): ?Schedule
    {
        $qb = $this->createQueryBuilder('dp')
            ->where('dp.child = :child')
            ->andWhere('dp.startTime BETWEEN :startOfDay AND :endOfDay')
                ->setParameter('startOfDay', $date->format('Y-m-d 00:00:00'))
                ->setParameter('endOfDay', $date->format('Y-m-d 23:59:59'))
            ->setParameter('child', $child);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function save(Schedule $dailyPanning): void
    {
        $this->getEntityManager()->persist($dailyPanning);
        $this->getEntityManager()->flush();
    }
}
