<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Destination
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table("shipto")
 */
class ShipTo
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"upload", "show"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"upload", "show"})
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"upload", "show"})
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"upload", "show"})
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"upload", "show"})
     */
    private $country;

    /**
     * Destination constructor.
     * @param int|null $id
     * @param string $name
     * @param string $address
     * @param string $city
     * @param string $country
     */
    public function __construct(
        int $id = null,
        string $name = null,
        string $address = null,
        string $city = null,
        string $country = null
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->country = $country;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
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
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }
}