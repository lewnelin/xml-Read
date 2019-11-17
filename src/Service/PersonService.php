<?php

namespace App\Service;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\Common\Collections\Collection;

/**
 * Class PersonService
 * @package App\Service
 */
class PersonService
{
    /**
     * @var PersonRepository
     */
    private $personRepository;

    /**
     * PersonService constructor.
     * @param PersonRepository $personRepository
     */
    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @param Collection $people
     * @internal param Person $person
     */
    public function savePeople(Collection $people)
    {
        foreach ($people as $person) {
            var_dump($person->getPhones()->first()); exit;
            $this->personRepository->persist($person);
        }

        $this->personRepository->flush();
    }
}