<?php

namespace DemoBundle\Controller\Admin;

use Bazookas\AdminBundle\Controller\AdminController\BaseAuditLogAdminController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListTablePageBuilderInterface;
use Bazookas\AdminBundle\PageBuilder\ListPageBuilder;
use Bazookas\CommonBundle\Entity\Interfaces\AccessControlInterface;
use Symfony\Component\HttpFoundation\Request;
use DemoBundle\Entity\AuditLog;
use Bazookas\AdminBundle\Security\Roles;

class AuditLogAdminController extends BaseAuditLogAdminController
{

  /**
   * @return null|string
   */
  protected function getEntityClass(): ?string {
    return AuditLog::class;
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
    /**
     * @var ListPageBuilder $builder
     */
    $builder = parent::modifyListBuilder($request, $builder);

    $builder->setMaintainFilterState(true);

    return $builder;
  }

  /**
   * @param string $action
   * @return bool
   */
  protected function hasAccess(string $action): bool {
    switch($action) {
      case AccessControlInterface::ACTION_LIST:
      case AccessControlInterface::ACTION_VIEW:
        return $this->isGranted(Roles::ROLE_SUPER_ADMIN);
      default:
        return false;
    }
  }
}
