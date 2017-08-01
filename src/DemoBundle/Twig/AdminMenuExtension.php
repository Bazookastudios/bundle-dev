<?php
namespace DemoBundle\Twig;

use Bazookas\AdminBundle\AdminElements\Containers\MenuContainer;
use Bazookas\AdminBundle\AdminElements\Elements\Actions\MenuActions\MenuActionElement;
use Bazookas\AdminBundle\Twig\Base\BaseAdminMenuExtension;
use Bazookas\CommonBundle\Security\Roles;
use Symfony\Component\HttpFoundation\Request;

class AdminMenuExtension extends BaseAdminMenuExtension
{

  protected function createMenu(Request $request)
  {
    $this->elements[] = (new MenuActionElement([], [
      'label' => 'admin.entities.example.menuLabel',
      'route' => 'demo_example_admin',
      'iconClass' => 'ti-info',
      'roles' => [Roles::ROLE_SUPER_ADMIN],
    ]));

    parent::createMenu($request);

    $this->addApiFrameworkBundleMenuItems();
  }

  /**
   * Add the api framework bundle menu items
   */
  protected function addApiFrameworkBundleMenuItems() {
//    $container = new MenuContainer([], [
//      'label' => 'admin.menu.app.label',
//      'roles' => [Roles::ROLE_SUPER_ADMIN],
//      'iconClass' => 'ti ti-mobile'
//    ]);


    // add the copy item
    $this->elements[] = (new MenuActionElement([], [
      'label' => 'admin.entities.appCopy.namePlural',
      'route' => 'bazookas_api_framework_app_copy_admin',
      'iconClass' => 'fa fa-language',
      'roles' => [Roles::ROLE_SUPER_ADMIN],
    ]));

    // add the app settings item
//    $container->addChild(new MenuActionElement([], [
//      'label' => 'admin.entities.appSettings.namePlural',
//      'route' => 'bazookas_api_framework_app_settings_admin',
//      'iconClass' => 'fa fa-gears',
//      'roles' => [Roles::ROLE_SUPER_ADMIN],
//    ]));

    // add it to the elements array
//    $this->elements[] = $container;
  }
}
