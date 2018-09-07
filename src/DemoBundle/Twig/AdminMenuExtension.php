<?php
namespace DemoBundle\Twig;

use APIFrameworkBundle\Menu\APIFrameworkMenuTrait;
use Bazookas\AdminBundle\AdminElements\Containers\MenuContainer;
use Bazookas\AdminBundle\AdminElements\Elements\Actions\MenuActions\MenuActionElement;
use Bazookas\AdminBundle\Twig\Base\BaseAdminMenuExtension;
use Bazookas\CommonBundle\Security\Roles;
use Bazookas\CronBundle\Menu\CronMenuTrait;
use Bazookas\MediaBundle\Menu\MediaMenuTrait;
use Symfony\Component\HttpFoundation\Request;

class AdminMenuExtension extends BaseAdminMenuExtension
{

//  use CronMenuTrait;
  use MediaMenuTrait;
//  use APIFrameworkMenuTrait;

  /**
   * @param Request $request
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function createMenu(Request $request): void
  {
    $this->addMenuHeader();

    $this->elements[] = new MenuActionElement([
      'label' => 'admin.menu.example.label',
      'route' => 'demo_example_admin',
      'iconClass' => 'ti-info',
      'roles' => [Roles::ROLE_SUPER_ADMIN],
    ]);

    $this->elements[] = new MenuActionElement([
      'label' => 'admin.menu.product.label',
      'route' => 'demo_product_admin',
      'iconClass' => 'ti-info',
      'roles' => [Roles::ROLE_SUPER_ADMIN],
    ]);

    $this->elements[] = new MenuActionElement([
      'label' => 'admin.menu.event.label',
      'route' => 'demo_event_admin',
      'iconClass' => 'fa fa-calendar',
      'roles' => [Roles::ROLE_SUPER_ADMIN],
    ]);

    $this->elements[] = new MenuActionElement([
      'label' => 'admin.menu.linkedListEntity.label',
      'route' => 'demo_linked_list_admin',
      'iconClass' => 'fa fa-link',
      'roles' => [Roles::ROLE_SUPER_ADMIN],
    ]);

//    $this->elements[] = $this->createApiFrameworkBundleMenuItems();

    $this->addMediaBundleMenuItems(true);
    $this->addAdminSettingsMenu();
  }

//  /**
//   * @return MenuContainer
//   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
//   */
//  private function createApiFrameworkBundleMenuItems(): MenuContainer {
//    return new MenuContainer(
//      [
//        'label' => 'admin.menu.containers.app',
//        'roles' => [Roles::ROLE_ADMIN],
//        'iconClass' => 'fa fa-list',
//        'children' => [
//          $this->createAppCopyMenuItem('bazookas_api_framework_app_copy_admin'),
//          $this->createAppSettingsMenuItem('bazookas_api_framework_app_settings_admin')
//        ]
//      ]
//    );
//  }
}
