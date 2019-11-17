<?php
namespace App\Controller;

use App\Entity\Person;
use App\Entity\Phone;
use App\Entity\ShipTo;
use App\Entity\Item;
use App\Entity\ShipOrder;
use App\Repository\ShipOrderRepository;
use App\Service\SerializerService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ShipOrderController
 * @package App\Controller
 */
class ShipOrderController extends AbstractController
{
    /**
     * @Route("/shiporder")
     * @param SerializerService $serializerService
     * @return Response
     */
    public function listAction(SerializerService $serializerService): Response
    {
        /** @var ShipOrderRepository $shipOrderRepository */
        $shipOrderRepository = $this->getDoctrine()->getRepository(ShipOrder::class);

        $serializerService->initSerializer(ShipOrder::class);
        $json = $serializerService->serialize($shipOrderRepository->findAll(), ['groups' => 'show']);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
