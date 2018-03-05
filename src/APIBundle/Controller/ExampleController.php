<?php

namespace ApiBundle\Controller\v1_0;

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

}
