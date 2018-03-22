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
   * @throws \Symfony\Component\Validator\Exception\MissingOptionsException
   * @throws \Symfony\Component\Validator\Exception\InvalidOptionsException
   * @throws \Symfony\Component\Validator\Exception\ConstraintDefinitionException
   */
  protected function getConfiguration(string $method): array {
    $updateConfiguration = [
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
        'created'
      ]
    ];

    $configuration = [
      Request::METHOD_GET => [
        'output' => [
          'title',
          'published',
          'singleImage' => [
            'id',
            'url'
          ],
          'multipleImages' => [
            'id',
            'url'
          ],
          'created'
        ],
      ],
      Request::METHOD_POST => $updateConfiguration, //create
      Request::METHOD_PATCH => $updateConfiguration, //update
      Request::METHOD_PUT => $updateConfiguration //update
    ];

    return $configuration[$method] ?? [];
  }
}
