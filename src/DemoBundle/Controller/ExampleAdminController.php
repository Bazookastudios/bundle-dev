<?php

namespace DemoBundle\Controller;

use Bazookas\AdminBundle\Controller\Base\BaseAdminListController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListPageBuilderInterface;
use Bazookas\AdminBundle\PageBuilder\ListPageBuilder;
use DemoBundle\Entity\Example;
use DemoBundle\Form\ExampleAdminType;
use Symfony\Component\HttpFoundation\Request;

class ExampleAdminController extends BaseAdminListController
{

  function __construct()
  {
    // make sure parent construct is called!
    parent::__construct();

    $this->builders[self::ACTION_BULK_EDIT] = null;
  }

  protected function modifyListBuilder(Request $request, ListPageBuilderInterface $builder)
  {
    /** @var ListPageBuilder $builder */
    $builder = parent::modifyListBuilder($request, $builder);

    $builder
      ->addBooleanField('published')
      ->addField('title')

      ->addBooleanFilterField('published')
      ->addTextFilterField('title')
    ;

    return $builder;
  }

  protected function hasAccess($action) {
    return parent::hasAccess($action) && $this->isGranted('ROLE_SUPER_ADMIN');
  }

  /**
   * @return string the entity fully qualified class name
   */
  protected function getEntityClass()
  {
    return Example::class;
  }

  /**
   * @param $action
   * @return string the fully qualified class name of the form
   */
  protected function getFormClass($action)
  {
    return ExampleAdminType::class;
  }
}
