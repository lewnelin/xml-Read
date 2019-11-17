<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Item
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table("item")
 */
class Item
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Groups({"upload", "show"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"upload", "show"})
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Groups({"upload", "show"})
     */
    private $note;

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @Groups({"upload", "show"})
     */
    private $quantity;

    /**
     * @var float
     * @ORM\Column(type="float")
     * @Groups({"upload", "show"})
     */
    private $price;

    /**
     * @var ShipOrder
     * @ORM\ManyToOne(targetEntity="ShipOrder", inversedBy="itens")
     * @Groups({"upload"})
     */
    private $shiporder;

    /**
     * Item constructor.
     * @param int $id
     * @param string $title
     * @param string $note
     * @param int $quantity
     * @param float $price
     * @param ShipOrder|null $shipOrder
     */
    public function __construct(
        int $id = null,
        string $title = null,
        string $note = null,
        int $quantity = null,
        float $price = null,
        ShipOrder $shipOrder = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->note = $note;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->shiporder = $shipOrder;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note)
    {
        $this->note = $note;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return ShipOrder
     */
    public function getShiporder(): ShipOrder
    {
        return $this->shiporder;
    }

    /**
     * @param ShipOrder $shiporder
     */
    public function setShiporder(ShipOrder $shiporder)
    {
        $this->shiporder = $shiporder;
    }
}
