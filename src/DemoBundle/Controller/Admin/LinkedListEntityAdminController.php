<?php

namespace DemoBundle\Controller\Admin;

use Bazookas\AdminBundle\PageBuilder\Interfaces\LinkedListPageBuilderInterface;
use Bazookas\AdminBundle\Controller\Base\BaseAdminLinkedListController;
use DemoBundle\Entity\LinkedListEntity;
use DemoBundle\Form\LinkedListEntityAdminType;
use Symfony\Component\HttpFoundation\Request;
use Bazookas\CommonBundle\Entity\Interfaces\AccessControlInterface;

class LinkedListEntityAdminController extends BaseAdminLinkedListController
{

  /**
   * @return string|null
   */
  protected function getEntityClass(): ?string {
    return LinkedListEntity::class;
  }

  /**
   * @param Request $request
   * @param LinkedListPageBuilderInterface $builder
   * @return LinkedListPageBuilderInterface
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function modifyListBuilder(Request $request, LinkedListPageBuilderInterface $builder): LinkedListPageBuilderInterface {
    $builder = parent::modifyListBuilder($request, $builder);

    $builder
      ->setListViewComponent('linked-list-view')
    ;

    $this->setScripts([
      'static/js/custom_admin_components.js'
    ]);

    return $builder;
  }

  /**
   * @param string $action
   * @return string|null
   */
  protected function getFormClass(string $action): ?string {
    switch($action) {
      case AccessControlInterface::ACTION_ADD:
      case AccessControlInterface::ACTION_EDIT:
        return LinkedListEntityAdminType::class;
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
      case AccessControlInterface::ACTION_LIST_DATA:
      case AccessControlInterface::ACTION_REMOVE:
      case self::ACTION_ORDER:
        return true;
      default:
        return false;
    }
  }

}
