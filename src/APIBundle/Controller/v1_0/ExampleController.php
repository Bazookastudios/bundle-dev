<?php

namespace APIBundle\Controller\v1_0;

use Bazookas\APIFrameworkBundle\Controller\Base\BaseRestController;
use Bazookas\APIFrameworkBundle\Services\Validation\ValidationService;
use DemoBundle\Entity\Example;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

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
      ],
      Request::METHOD_POST => [
        //The constraints against which the input should be validated
        'constraints' => [
          'title' => [
            'constraint' => new NotBlank()
          ],
          'published' => [
            'constraint' => new Type('boolean')
          ],
          'created' => [
            'constraint' => new NotBlank(),
            'convertToType' => ValidationService::TYPE_DATETIME
          ]
        ],
        //the input fields
        'input' => [
          'title',
          'published',
//          'singleImage',
//          'multipleImages',
          'created'
        ]
      ]
    ];

    return $configuration[$method] ?? [];
  }
}
