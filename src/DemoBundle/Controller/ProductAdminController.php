<?php

namespace DemoBundle\Controller;

use Bazookas\AdminBundle\Controller\Base\BaseAdminListController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListPageBuilderInterface;
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
      case self::ACTION_ADD:
      case self::ACTION_EDIT:
      case self::ACTION_CLONE:
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
      case self::ACTION_LIST:
      case self::ACTION_EDIT:
      case self::ACTION_ADD:
      case self::ACTION_REMOVE:
      case self::ACTION_CLONE:
      case self::ACTION_BULK_REMOVE:
        return true;
      default:
        return false;
    }
  }

}
