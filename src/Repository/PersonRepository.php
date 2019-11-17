<?php
namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PersonRepository
 * @package App\Repository
 */
class PersonRepository extends ServiceEntityRepository
{
    /**
     * PersonRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @param Person $person
     */
    public function persist(Person $person)
    {
        $this->getEntityManager()->persist($person);
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}
