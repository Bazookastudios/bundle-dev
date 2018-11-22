<?php

namespace DemoBundle\Controller\Admin;

use Bazookas\AdminBundle\Controller\Base\BaseAdminListTableController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListTablePageBuilderInterface;
use DemoBundle\Entity\Event;
use DemoBundle\Form\EventAdminType;
use Symfony\Component\HttpFoundation\Request;
use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;

class EventAdminController extends BaseAdminListTableController
{

  /**
   * @return string|null
   */
  protected function getEntityClass(): ?string {
    return Event::class;
  }

  /**
   * @param Request $request
   * @param ListTablePageBuilderInterface $builder
   * @return ListTablePageBuilderInterface
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function modifyListBuilder(
    Request $request,
    ListTablePageBuilderInterface $builder
  ): ListTablePageBuilderInterface {
    $builder = parent::modifyListBuilder($request, $builder);

    $builder
      ->addDateTimeField('date')
      ->addField('title');

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
        return EventAdminType::class;
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
        return true;
      default:
        return false;
    }
  }

}
