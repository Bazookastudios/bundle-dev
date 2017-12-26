<?php

namespace DemoBundle\Controller;

use Bazookas\AdminBundle\Controller\AdminController\BaseAuditLogAdminController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListPageBuilderInterface;
use Bazookas\AdminBundle\PageBuilder\ListPageBuilder;
use Bazookas\CommonBundle\Entity\Interfaces\AccessControlInterface;
use Symfony\Component\HttpFoundation\Request;
use DemoBundle\Entity\AuditLog;
use Bazookas\AdminBundle\Security\Roles;

class AuditLogAdminController extends BaseAuditLogAdminController
{

  protected function getEntityClass(): ?string
  {
    return AuditLog::class;
  }

  protected function modifyListBuilder(Request $request, ListPageBuilderInterface $builder): ListPageBuilderInterface
  {
    /**
     * @var ListPageBuilder $builder
     */
    $builder = parent::modifyListBuilder($request, $builder);

    $builder->setMaintainFilterState(true);

    return $builder;
  }

  protected function getFormClass(string $action): ?string
  {
    return null;
  }

  protected function hasAccess(string $action): bool
  {
    switch ($action) {
      case AccessControlInterface::ACTION_LIST:
      case AccessControlInterface::ACTION_VIEW:
        return $this->isGranted(Roles::ROLE_SUPER_ADMIN);
      default:
        return false;
    }
  }
}
