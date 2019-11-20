<?php

namespace App\Services\Upload;

use Bazookas\MediaBundle\Services\Data\ImageCallbackService;
use Nitro\ApiUploadBundle\Services\Interfaces\ApiUploadHandlerInterface;
use Nitro\ApiUploadBundle\Services\Traits\ApiUploadHandlerTrait;
use Psr\Container\ContainerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use function realpath;

/**
 * Class UploadHandlerService
 * @package App\Services\Upload
 */
class UploadHandlerService implements ApiUploadHandlerInterface, ServiceSubscriberInterface
{
    use ApiUploadHandlerTrait;

    /**
     * UploadHandlerService constructor.
     *
     * @param string|null        $baseUrl
     * @param string             $publicDirectory
     * @param string             $uploadsDirectory
     * @param ContainerInterface $container
     * @param RouterInterface    $router
     */
    public function __construct(
        ?string $baseUrl,
        string $publicDirectory,
        string $uploadsDirectory,
        ContainerInterface $container,
        RouterInterface $router
    ) {
        $this->baseUrl = $baseUrl;
        if (empty($baseUrl)) {
            $context = $router->getContext();
            $this->baseUrl = $context->getScheme().'://'.$context->getHost();

            if ($context->getScheme() === 'http' && $context->getHttpPort() !== 80) {
                $this->baseUrl .= ':'.$context->getHttpPort();
            }
            $this->baseUrl .= $context->getBaseUrl();
        }

        $this->container = $container;
        $this->publicDirectory = realpath($publicDirectory);
        $this->uploadsDirectory = realpath($uploadsDirectory);
    }

    /**
     * @return array
     */
    public static function getSubscribedServices(): array
    {
        return [
            ImageCallbackService::class => ImageCallbackService::class,
        ];
    }
}
