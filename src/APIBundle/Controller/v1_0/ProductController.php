<?php

namespace APIBundle\Controller\v1_0;

use Bazookas\APIFrameworkBundle\Controller\Base\BaseRestController;
use DemoBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

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
   * @throws \Symfony\Component\Validator\Exception\MissingOptionsException
   * @throws \Symfony\Component\Validator\Exception\InvalidOptionsException
   * @throws \Symfony\Component\Validator\Exception\ConstraintDefinitionException
   */
  protected function getConfiguration(string $method): array {
    $configuration = [
      Request::METHOD_GET => [
        'output' => [
          'details' => [
            'id',
            'title',
            'choiceField',
            'sendDateTime'
          ]
        ],
      ],
    ];

    return $configuration[$method] ?? [];
  }
}
