<?php
namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use App\Service\SerializerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonController
 * @package App\Controller
 */
class PersonController extends AbstractController
{
    /**
     * @Route("/people")
     * @param SerializerService $serializerService
     * @return Response
     */
    public function listAction(SerializerService $serializerService): Response
    {
        /** @var PersonRepository $personRepository */
        $personRepository = $this->getDoctrine()->getRepository(Person::class);

        $serializerService->initSerializer();
        $json = $serializerService->serialize($personRepository->findAll(), ['groups' => ['show']]);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
