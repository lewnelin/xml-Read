<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ShipOrder
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ShipOrderRepository")
 * @ORM\Table("shiporder")
 */
class ShipOrder
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Groups({"upload", "show"})
     */
    private $id;

    /**
     * @var Person
     * @ORM\OneToOne(targetEntity="Person", cascade={"persist"})
     * @Groups({"upload", "show"})
     */
    private $person;

    /**
     * @var ShipTo
     * @ORM\OneToOne(targetEntity="ShipTo", cascade={"persist", "remove"})
     * @Groups({"upload", "show"})
     */
    private $shipto;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Item", mappedBy="shiporder", cascade={"persist", "merge", "remove"})
     * @ORM\JoinColumn(name="items", referencedColumnName="shiporder")
     * @Groups({"show"})
     */
    private $items;

    /**
     * ShipOrder constructor.
     * @param int $id
     * @param Person $person
     * @param ShipTo $shipto
     * @param Collection $items
     */
    public function __construct(
        int $id = null,
        Person $person = null,
        ShipTo $shipto = null,
        Collection $items = null
    ) {
        $this->id = $id;
        $this->person = $person;
        $this->shipto = $shipto;
        $this->items = $items ?? new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
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
     * @return Person
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @return ShipTo
     */
    public function getShipto(): ?ShipTo
    {
        return $this->shipto;
    }

    /**
     * @param ShipTo $shipto
     */
    public function setShipto(ShipTo $shipto)
    {
        $this->shipto = $shipto;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param Collection $items
     */
    public function setItems(Collection $items)
    {
        $this->items = $items;
    }

    /**
     * @param Item $item
     */
    public function addItem(Item $item)
    {
        $this->items->add($item);
        $item->setShiporder($this);
    }
}
