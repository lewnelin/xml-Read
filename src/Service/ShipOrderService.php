<?php

namespace App\Service;

use App\Repository\ShipOrderRepository;
use Doctrine\Common\Collections\Collection;

/**
 * Class ShipOrderService
 * @package App\Service
 */
class ShipOrderService
{
    /**
     * @var ShipOrderRepository
     */
    private $shipOrderRepository;

    /**
     * PersonService constructor.
     * @param ShipOrderRepository $shipOrderRepository
     */
    public function __construct(ShipOrderRepository $shipOrderRepository)
    {
        $this->shipOrderRepository = $shipOrderRepository;
    }

    /**
     * @param Collection $shipOrders
     */
    public function saveShipOrders(Collection $shipOrders)
    {
        foreach ($shipOrders as $shipOrder) {
            $this->shipOrderRepository->persist($shipOrder);
        }

        $this->shipOrderRepository->flush();
    }
}