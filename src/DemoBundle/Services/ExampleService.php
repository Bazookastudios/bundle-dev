<?php

namespace DemoBundle\Services;

use Bazookas\APIFrameworkBundle\Services\Data\Interfaces\DataServiceInterface;
use Bazookas\APIFrameworkBundle\Services\Upload\ApiFileUploadService;
use Bazookas\APIFrameworkBundle\Util\ApiFileUploadCallback;
use DemoBundle\Entity\Example;
use DemoBundle\Repository\ExampleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class ExampleService implements DataServiceInterface
{

  /**
   * @var ExampleRepository
   */
  protected $repository;

  /**
   * @var ApiFileUploadService
   */
  private $uploadService;

  /**
   * @var EntityManagerInterface
   */
  private $entityManager;

  /**
   * ExampleService constructor.
   * @param ApiFileUploadService $uploadService
   * @param EntityManagerInterface $entityManager
   */
  public function __construct(ApiFileUploadService $uploadService, EntityManagerInterface $entityManager)
  {
    $this->repository = $entityManager->getRepository(Example::class);
    $this->uploadService = $uploadService;
    $this->entityManager = $entityManager;
  }

  /**
   * @param ParameterBag $paramBag
   * @return array
   * @throws \Symfony\Component\Routing\Exception\RouteNotFoundException
   * @throws \Symfony\Component\Routing\Exception\MissingMandatoryParametersException
   * @throws \Symfony\Component\Routing\Exception\InvalidParameterException
   * @throws \Doctrine\ORM\ORMInvalidArgumentException
   * @throws \Bazookas\APIFrameworkBundle\Exception\ApiException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function postExample(ParameterBag $paramBag)
  {
    // NOTE: "parameters" of callback are converted to a parameterbag upon calling the callback
    // dummy image upload targets
    $uploadTargets = $this->uploadService->createFileUploads(array(
      2 => [
        'targetDirectory' => 'images',
        'overwrite' => false,
        'filename' => 'two',
        'callback' => new ApiFileUploadCallback(
          'bazookas.media.data_service.api_call_back_service',
          'uploadComplete',
          new ParameterBag(['id' => 3])
        ),
      ],
      0 => [
        'targetDirectory' => 'images',
        'overwrite' => false,
        'filename' => 'zero',
        'callback' => new ApiFileUploadCallback(
          'bazookas.media.data_service.api_call_back_service',
          'uploadComplete',
          new ParameterBag(['id' => 4])
        ),
      ],
      1 => [
        'targetDirectory' => 'images',
        'overwrite' => false,
        'filename' => 'one',
        'callback' => new ApiFileUploadCallback(
          'bazookas.media.data_service.api_call_back_service',
          'uploadComplete',
          new ParameterBag(['id' => 5])
        ),
      ],
    ), new ApiFileUploadCallback('demo_bundle.services.example_service', 'publishExample', new ParameterBag(['id' => 1])));

    return array(
      'status' => 'success',
      'uploadTargets' => $uploadTargets,
    );
  }

  public function publishExample(ParameterBag $paramBag)
  {
    // NOTE an instance of ApiFileUpload is passed when used as callback
    // You don't need to do anything with it, but you might like it
    $apiFileUpload = $paramBag->get('ApiFileUpload');

    $id = $paramBag->get('id');

    $example = $this->repository->find($id);
    if ($example) {
      $example->setPublished(true);
      $this->entityManager->persist($example);
      $this->entityManager->flush();

      return array(
        'status' => 'success',
      );
    }

    return array(
      'status' => 'not-found',
    );
  }

  public function getExamples(ParameterBag $paramBag)
  {
    $page = $paramBag->get('page', 0);
    // TODO locale?

    $result = $this->repository->getPagedList($page);

    return array(
      'status' => 'success',
      'data' => $result['data'],
      'pages' => $result['pages'],
    );
  }


}
