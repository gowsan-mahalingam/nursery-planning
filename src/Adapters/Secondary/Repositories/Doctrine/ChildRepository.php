<?php

namespace App\Adapters\Secondary\Repositories\Doctrine;

use App\Adapters\Secondary\Repositories\ChildRepositoryInterface;
use App\BusinessLogic\Models\Child;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ChildRepository extends ServiceEntityRepository implements ChildRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Child::class);
    }

}
