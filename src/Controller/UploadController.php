<?php
namespace App\Controller;

use App\Form\UploadFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonController
 */
class UploadController extends AbstractController
{
    /**
     * @Route("/upload", methods={"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadFormAction(Request $request)
    {
        $form = $this->createForm(UploadFormType::class, $request->get('option'));

        return $this->render('default.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/upload", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadAction(Request $request)
    {
        $files = $request->files->get('upload_form');

        if (isset($files['xml'])) {
            return new JsonResponse('Success');
        }

        return new JsonResponse('Error');
    }
}
