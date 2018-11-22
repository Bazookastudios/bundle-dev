<?php

namespace DemoBundle\Controller\Admin;

use Bazookas\AdminBundle\Controller\Base\BaseAdminListTableController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListTablePageBuilderInterface;
use Bazookas\AdminBundle\Security\Roles;
use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use DemoBundle\Entity\Example;
use DemoBundle\Form\ExampleAdminType;
use DemoBundle\PageBuilder\ExamplePageBuilder;
use Symfony\Component\HttpFoundation\Request;

class ExampleAdminController extends BaseAdminListTableController
{

  public function __construct() {
    // make sure parent construct is called!
    parent::__construct();

    $this->builders[AccessControlInterface::ACTION_LIST] = ExamplePageBuilder::class;
  }

  /**
   * @param Request $request
   * @param ListTablePageBuilderInterface $builder
   * @return ListTablePageBuilderInterface
   */
  protected function modifyListBuilder(
    Request $request,
    ListTablePageBuilderInterface $builder
  ): ListTablePageBuilderInterface {
    $builder = parent::modifyListBuilder($request, $builder);

    $builder
      ->addBooleanField('published')
      ->addSortableField('title')
      ->addBooleanFilterField('published')
      ->addTextFilterField('title');

    return $builder;
  }

  /**
   * @param string $action
   * @return bool
   * @throws \LogicException
   */
  protected function hasAccess(string $action): bool {
    switch($action) {
      case AccessControlInterface::ACTION_LIST:
      case AccessControlInterface::ACTION_EDIT:
      case AccessControlInterface::ACTION_ADD:
      case AccessControlInterface::ACTION_REMOVE:
      case AccessControlInterface::ACTION_CLONE:
        return Roles::ROLE_SUPER_ADMIN;
      default:
        return false;
    }
  }

  /**
   * @return string the entity fully qualified class name
   */
  protected function getEntityClass(): ?string {
    return Example::class;
  }

  /**
   * @param $action
   * @return string the fully qualified class name of the form
   */
  protected function getFormClass(string $action): ?string {
    return ExampleAdminType::class;
  }
}
