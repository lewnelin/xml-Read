<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Class Person
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 * @ORM\Table("people")
 */
class Person
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var Collection
     * @ORM\ManyToOne(targetEntity="Phone", inversedBy="person")
     * @ORM\JoinColumn(name="phones", referencedColumnName="id")
     */
    private $phones;

    /**
     * Person constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->phones = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection
     */
    public function getPhones(): ?Collection
    {
        return $this->phones;
    }

    /**
     * @param Phone $phone
     */
    public function addPhone(Phone $phone): void
    {
        $this->phones->add($phone);
    }
}