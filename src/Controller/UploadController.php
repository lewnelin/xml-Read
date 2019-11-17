<?php
namespace App\Controller;

use App\Form\UploadFormType;
use App\Service\FileUploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonController
 */
class UploadController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
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
     * @param FileUploadService $fileUploadService
     * @return JsonResponse
     */
    public function uploadAction(
        Request $request,
        FileUploadService $fileUploadService
    ): JsonResponse {
        try {
            $files = $request->files->get('upload_form');
            /** @var UploadedFile $xmlFile */
            $xmlFile = $files['xml'] ?? false;

            $fileUploadService->uploadXmlFile($xmlFile);

            $response = 'Success';
        } catch (\Throwable $exception) {
            $response = 'An Error Occurred: ' . $exception->getMessage();
        }
        return new JsonResponse($response);
    }
}
