<?php
/**
 * Created by PhpStorm.
 * User: Sebastiao
 * Date: 17/11/2019
 * Time: 10:14
 */

namespace App\Tests\Entity;

use App\Entity\Item;
use App\Entity\Person;
use App\Entity\Phone;
use App\Entity\ShipOrder;
use App\Entity\ShipTo;
use App\Repository\ShipOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class ShipOrderPersistTest
 * @package App\Tests\Entity
 */
class ShipOrderPersistTest extends TestCase
{
    /**
     * @param ShipOrderRepository $shipOrderRepository
     */
    public function testCreateShipOrder(ShipOrderRepository $shipOrderRepository)
    {
        $shipOrder = new ShipOrder(1);
        $items = new ArrayCollection([
            new Item(1, 'Item 1', 'Note 1', 100, 21.2, $shipOrder),
            new Item(2, 'Item 2', 'Note 2', 100, 21.3, $shipOrder)
        ]);
        $shipOrder->setItems($items);

        $shipTo = new ShipTo(1, 'Place 1', 'Address 1', 'City 1', 'Country 1');
        $shipOrder->setShipto($shipTo);

        $person = new Person(6, 'Name 6', new ArrayCollection([new Phone('7775135')]));
        $shipOrder->setPerson($person);

        $shipOrderRepository->persist($shipOrder);
        $shipOrderRepository->flush();


    }
}