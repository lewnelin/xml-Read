<?php
namespace App\Controller;

use App\Entity\ShipOrder;
use App\Repository\ShipOrderRepository;
use App\Service\SerializerService;
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

        $serializerService->initSerializer();
        $json = $serializerService->serialize($shipOrderRepository->findAll(), ['groups' => 'show']);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
