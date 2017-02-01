<?php

namespace DemoBundle\Services;

use Bazookas\APIFrameworkBundle\Entity\APIFileUpload;
use Bazookas\APIFrameworkBundle\Services\Data\Base\BaseDataService;
use Bazookas\APIFrameworkBundle\Services\Upload\APIFileUploadService;
use Bazookas\APIFrameworkBundle\Services\Upload\FileUploadService;
use Bazookas\APIFrameworkBundle\Util\APIFileUploadCallback;
use DemoBundle\Repository\ExampleRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\ParameterBag;

class ExampleService extends BaseDataService {

  /**
   * @var ExampleRepository
   */
  protected $repository;

  /**
   * @var APIFileUploadService
   */
  private $uploadService;

  /**
   * @var EntityManager
   */
  private $entityManager;

  public function __construct(ExampleRepository $repository, APIFileUploadService $uploadService, EntityManager $entityManager) {
    $this->setRepository($repository);
    $this->uploadService = $uploadService;
    $this->entityManager = $entityManager;
  }

  public function postExample(ParameterBag $paramBag, ParameterBag $extraParams = null) {
    // TODO parse parameterbag and create a new example instance

    // NOTE: "parameters" of callback are converted to a parameterbag upon calling the callback
    // dummy image upload targets
    $uploadTargets = $this->uploadService->createFileUploads(array(
      2 => array(
        'targetDirectory' => 'images',
        'overwrite' => false,
        'filename' => 'two',
        'callback' => new APIFileUploadCallback(
          'BazookasMediaBundle.dataService.APICallBackService',
          'uploadComplete',
          array('id'=>3)
        ),
      ),
      0 => array(
        'targetDirectory' => 'images',
        'overwrite' => false,
        'filename' => 'zero',
        'callback' => new APIFileUploadCallback(
          'BazookasMediaBundle.dataService.APICallBackService',
          'uploadComplete',
          array('id'=>4)
        ),
      ),
      1 => array(
        'targetDirectory' => 'images',
        'overwrite' => false,
        'filename' => 'one',
        'callback' => new APIFileUploadCallback(
          'BazookasMediaBundle.dataService.APICallBackService',
          'uploadComplete',
          array('id'=>5)
        ),
      ),
    ), new APIFileUploadCallback('demo.example.service', 'publishExample', array('id'=>1)));

    return array(
      'status' => 'success',
      'uploadTargets' => $uploadTargets,
    );

    $entity = $this->repository->create($paramBag);
  }

  public function publishExample(ParameterBag $paramBag, ParameterBag $extraParams = null) {
    // NOTE an instance of APIFileUpload is passed when used as callback
    // You don't need to do anything with it, but you might like it
    $apiFileUpload = $paramBag->get('APIFileUpload');


    $id = $paramBag->get('id');
    if (!empty($extraParams)) {
      $id = $extraParams->get('id');
    }

    $example = $this->repository->find($id);
    if ($example) {
      $example->setPublished(true);
      $this->entityManager->persist($example);
      $this->entityManager->flush();

      return array(
        'status' => 'success',
      );
    }
    else {
      return array(
        'status' => 'not-found',
      );
    }
  }

  public function getExamples(ParameterBag $paramBag, ParameterBag $extraParams = null) {
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
