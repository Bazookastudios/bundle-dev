<?php

namespace APIBundle\Controller\v1_0;

use Bazookas\APIFrameworkBundle\Controller\Base\BaseRestController;
use DemoBundle\Entity\Example;
use Symfony\Component\HttpFoundation\Request;

class ExampleController extends BaseRestController
{

  /**
   * @inheritdoc
   */
  protected function getEntityClass(): string {
    return Example::class;
  }

  /**
   * @inheritdoc
   */
  protected function getConfiguration(string $method): array {
    $configuration = [
      Request::METHOD_GET => [
        //        'formatter' => '',
        //        'input' => [],
        'output' => [
          'title',
          'published',
          'singleImage',
          'multipleImages',
          'created'
        ],
        //        'service' => ''
      ]
    ];

    return $configuration[$method] ?? [];
  }
}
