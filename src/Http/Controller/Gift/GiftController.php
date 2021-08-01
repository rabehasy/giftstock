<?php

namespace App\Http\Controller\Gift;

use App\Domain\Gift\UploadedGiftMessage;
use App\Infrastructure\Services\UploadFile;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/gifts")
 */
class GiftController extends AbstractController
{
    /**
     * @Route("/batch-upload", name="api_gift_batch", methods={"POST"})
     */
    public function batchUpload(Request $request, UploadFile $uploadFile, MessageBusInterface $messageBus): JsonResponse
    {
        $file = $request->files->get('filename');
        try {
            // Upload file to tmp
            $filename = $uploadFile->upload($file);

            // Messenger - save batch
            $message = new UploadedGiftMessage($filename, $this->getParameter('tmp_directory'));
            $messageBus->dispatch($message);
        } catch (Exception $exception) {
            return new JsonResponse($exception->getMessage());
        }

        return new JsonResponse('gift file successfully uploaded');
    }
}
