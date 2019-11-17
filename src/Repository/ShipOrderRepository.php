<?php

namespace App\Repository;

use App\Entity\ShipOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ShipOrderRepository
 * @package App\Repository
 */
class ShipOrderRepository extends ServiceEntityRepository
{
    /**
     * PersonRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShipOrder::class);
    }

    /**
     * @param ShipOrder $shipOrder
     */
    public function persist(ShipOrder $shipOrder)
    {
        $this->getEntityManager()->persist($shipOrder);
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}
