<?php
namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use App\Service\SerializerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonController
 */
class PersonController extends AbstractController
{
    /**
     * @Route("/people")
     * @param SerializerService $serializerService
     * @return JsonResponse
     */
    public function listAction(SerializerService $serializerService): JsonResponse
    {
        /** @var PersonRepository $personRepository */
        $personRepository = $this->getDoctrine()->getRepository(Person::class);

        $serializerService->initSerializer();
        $response = $serializerService->serialize($personRepository->findAll());

        return new JsonResponse($response);
    }
}
