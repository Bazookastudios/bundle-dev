<?php

namespace DemoBundle\Controller\Admin;

use Bazookas\AdminBundle\Controller\Base\BaseAdminListController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListPageBuilderInterface;
use Bazookas\CommonBundle\Entity\Interfaces\AccessControlInterface;
use DemoBundle\Entity\Product;
use DemoBundle\Form\ProductAdminType;
use Symfony\Component\HttpFoundation\Request;
use Bazookas\AdminBundle\PageBuilder\ListPageBuilder;

class ProductAdminController extends BaseAdminListController
{

  /**
  * @return string
  */
  protected function getEntityClass(): string
  {
    return Product::class;
  }

  /**
   * @param Request $request
   * @param ListPageBuilderInterface $builder
   * @return ListPageBuilderInterface
   * @throws \LogicException
   * @throws \Exception
   * @throws \ReflectionException
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function modifyListBuilder(Request $request, ListPageBuilderInterface $builder) : ListPageBuilderInterface
  {
    /** @var ListPageBuilder $builder */
    $builder = parent::modifyListBuilder($request, $builder);

    $builder
      ->addDetailsField('title');

    return $builder;
  }

  /**
  * @param string $action
  * @return string|null
  */
  protected function getFormClass(string $action): string {
    switch($action) {
      case AccessControlInterface::ACTION_ADD:
      case AccessControlInterface::ACTION_EDIT:
      case AccessControlInterface::ACTION_CLONE:
        return ProductAdminType::class;
      default:
        return null;
    }
  }

  /**
  * @param string $action
  * @return bool
  */
  protected function hasAccess(string $action): bool {
    switch($action) {
      case AccessControlInterface::ACTION_LIST:
      case AccessControlInterface::ACTION_EDIT:
      case AccessControlInterface::ACTION_ADD:
      case AccessControlInterface::ACTION_REMOVE:
      case AccessControlInterface::ACTION_CLONE:
        return true;
      default:
        return false;
    }
  }

}
