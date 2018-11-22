<?php

namespace DemoBundle\Controller\Admin;

use Bazookas\AdminBundle\Controller\Base\BaseAdminListTableController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListTablePageBuilderInterface;
use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use DemoBundle\Entity\Product;
use DemoBundle\Form\ProductAdminType;
use Symfony\Component\HttpFoundation\Request;

class ProductAdminController extends BaseAdminListTableController
{

  /**
   * @return string
   */
  protected function getEntityClass(): string {
    return Product::class;
  }

  /**
   * @param Request $request
   * @param ListTablePageBuilderInterface $builder
   * @return ListTablePageBuilderInterface
   * @throws \LogicException
   * @throws \Exception
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function modifyListBuilder(
    Request $request,
    ListTablePageBuilderInterface $builder
  ): ListTablePageBuilderInterface {
    $builder = parent::modifyListBuilder($request, $builder);

    $builder
      ->addDetailsField('title')
      ->addDetailsFilterField('title');

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
