<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Phone
 * @ORM\Entity(repositoryClass="App\Repository\PhoneRepository")
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
    private $phone;

    /**
     * @var Person
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="phones")
     */
    private $person;

    /**
     * Phone constructor.
     * @param string $phone
     * @internal param int $id
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
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
    public function getphone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setphone($phone): void
    {
        $this->phone = $phone;
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