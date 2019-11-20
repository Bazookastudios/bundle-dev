<?php

namespace App\Controller\Api;

use Bazookas\MediaBundle\Entity\Image;
use Bazookas\MediaBundle\Services\Data\ImageCallbackService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Nitro\ApiUploadBundle\Factory\ApiFileUploadFactory;
use Nitro\ApiUploadBundle\Model\ApiUploadCallback;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ImageUploadController
 * @package App\Controller\Api
 */
class ImageUploadController
{
    /**
     * @param ApiFileUploadFactory   $fileUploadFactory
     * @param EntityManagerInterface $manager
     *
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function createImageUploadAction(
        ApiFileUploadFactory $fileUploadFactory,
        EntityManagerInterface $manager
    ): JsonResponse {
        $image = new Image();
        $manager->persist($image);

        $uploadTargets = $fileUploadFactory->createFileUploads([
            [
                'targetDirectory' => 'images',
                'filename' => $image->getId(),
                'mimeTypes' => '#^image/.+$#',
                'callback' => new ApiUploadCallback(
                    'uploadCroppedImage',
                    new ParameterBag([
                        'id' => $image->getId(),
                        'width' => 500,
                        'height' => 500,
                    ]),
                    ImageCallbackService::class
                ),
            ],
        ]);

        return new JsonResponse(['upload_targets' => $uploadTargets]);
    }
}
