<?php

namespace App\Controller\Api;

use Bazookas\APIFrameworkBundle\Services\Upload\ApiFileUploadService;
use Bazookas\APIFrameworkBundle\Util\ApiFileUploadCallback;
use Bazookas\MediaBundle\Entity\Image;
use Bazookas\MediaBundle\Services\Data\ImageCallbackService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ImageUploadController
 * @package App\Controller\Api
 */
class ImageUploadController
{
    /**
     * @param ApiFileUploadService   $fileUploadService
     * @param EntityManagerInterface $manager
     *
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function createImageUploadAction(
        ApiFileUploadService $fileUploadService,
        EntityManagerInterface $manager
    ): JsonResponse {
        $image = new Image();
        $manager->persist($image);

        $uploadTargets = $fileUploadService->createFileUploads([
            [
                'targetDirectory' => 'images',
                'filename' => $image->getId(),
                'mimeTypes' => '#^image/.+$#',
                'callback' => new ApiFileUploadCallback(
                    ImageCallbackService::class,
                    'uploadCroppedImage',
                    new ParameterBag([
                        'id' => $image->getId(),
                        'width' => 500,
                        'height' => 500,
                    ])
                ),
            ],
        ]);

        return new JsonResponse(['upload_targets' => $uploadTargets]);
    }
}
