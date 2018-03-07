<?php

namespace APIBundle\Controller\v1_0;

use Bazookas\APIFrameworkBundle\Controller\Base\BaseRestController;
use DemoBundle\Entity\Example;

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



    //TODO add this



    return [];
  }
}
