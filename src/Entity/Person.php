<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

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
     * @ORM\Column(type="integer")
     * @Groups({"group1"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"group1"})
     */
    private $name;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="person", cascade={"persist", "merge", "remove"})
     * @ORM\JoinColumn(name="phones", referencedColumnName="id")
     */
    private $phones;

    /**
     * Person constructor.
     * @param int $id
     * @param string $name
     * @param Collection|null $phones
     * @internal param int $id
     */
    public function __construct(int $id, string $name, Collection $phones = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phones = $phones ?? new ArrayCollection();
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

    /**
     * @param array $phones
     */
    public function setPhones(array $phones)
    {
        $this->phones = new ArrayCollection($phones);
    }
}