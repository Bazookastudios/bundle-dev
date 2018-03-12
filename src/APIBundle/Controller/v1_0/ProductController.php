<?php

namespace APIBundle\Controller\v1_0;

use Bazookas\APIFrameworkBundle\Controller\Base\BaseRestController;
use DemoBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends BaseRestController
{

  /**
   * @inheritdoc
   */
  protected function getEntityClass(): string {
    return Product::class;
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
          //Option 1
//          'details',
          //Option 2
          'details' => [
            'id',
            'title',
            'choiceField',
            'sendDateTime'
          ]
        ],
        //        'service' => ''
      ]
    ];

    return $configuration[$method] ?? [];
  }
}
