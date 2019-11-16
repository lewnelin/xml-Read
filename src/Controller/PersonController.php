<?php
namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
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
     * @return JsonResponse
     */
    public function listAction(): JsonResponse
    {
        /** @var PersonRepository $personRepository */
        $personRepository = $this->getDoctrine()->getRepository(Person::class);

        return new JsonResponse($personRepository->findAll());
    }
}
