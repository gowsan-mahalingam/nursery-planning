<?php

namespace App\Adapters\Secondary\Repositories\Doctrine;

use App\Adapters\Secondary\Repositories\ParentsRepositoryInterface;
use App\BusinessLogic\Models\Parents;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ParentsRepository extends ServiceEntityRepository implements ParentsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parents::class);
    }

}
