<?php

namespace DemoBundle\Controller\Admin;

use Bazookas\AdminBundle\Controller\Base\BaseAdminListController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListPageBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Bazookas\CommonBundle\Entity\Interfaces\AccessControlInterface;

class EventAdminController extends BaseAdminListController
{

  /**
   * @return string|null
   */
  protected function getEntityClass(): ?string
  {
    return Event::class;
  }

  /**
   * @param Request $request
   * @param ListPageBuilderInterface $builder
   * @return ListPageBuilderInterface
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function modifyListBuilder(Request $request, ListPageBuilderInterface $builder): ListPageBuilderInterface
  {
    $builder = parent::modifyListBuilder($request, $builder);

    //TODO modify the builder here

    return $builder;
  }

  /**
   * @param string $action
   * @return string|null
   */
  protected function getFormClass(string $action): ?string
  {
    switch($action) {
      case AccessControlInterface::ACTION_ADD:
      case AccessControlInterface::ACTION_EDIT:
        //TODO add a form class
        return null;
      default:
        return null;
    }
  }

  /**
   * @param string $action
   * @return bool
   */
  protected function hasAccess(string $action): bool
  {
    switch($action) {
      case AccessControlInterface::ACTION_LIST:
      case AccessControlInterface::ACTION_EDIT:
      case AccessControlInterface::ACTION_ADD:
      case AccessControlInterface::ACTION_REMOVE:
        return true;
      default:
        return false;
    }
  }

}
