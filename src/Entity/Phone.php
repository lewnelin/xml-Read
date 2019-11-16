<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Phone
 * @ORM\Table("phones")
 */
class Phone
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $number;

    /**
     * @var Person
     * @ORM\OneToMany(targetEntity="Person", inversedBy="phones")
     */
    private $person;

    /**
     * Phone constructor.
     * @param string $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return Person
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person): void
    {
        $this->person = $person;
    }
}