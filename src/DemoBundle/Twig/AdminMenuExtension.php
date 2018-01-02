<?php
namespace DemoBundle\Twig;

use Bazookas\AdminBundle\AdminElements\Containers\MenuContainer;
use Bazookas\AdminBundle\AdminElements\Elements\Actions\MenuActions\MenuActionElement;
use Bazookas\AdminBundle\Twig\Base\BaseAdminMenuExtension;
use Bazookas\CommonBundle\Security\Roles;
use Symfony\Component\HttpFoundation\Request;

class AdminMenuExtension extends BaseAdminMenuExtension
{

  /**
   * @param Request $request
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function createMenu(Request $request): void
  {
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

    parent::createMenu($request);

    $this->addApiFrameworkBundleMenuItems();
  }

  /**
   * Add the api framework bundle menu items
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function addApiFrameworkBundleMenuItems() {
    // add the copy item
//    $this->elements[] = new MenuActionElement([
//      'label' => 'admin.entities.appCopy.namePlural',
//      'route' => 'bazookas_api_framework_app_copy_admin',
//      'iconClass' => 'fa fa-language',
//      'roles' => [Roles::ROLE_SUPER_ADMIN],
//    ]);

    // add the app settings item
//    $container->addChild(new MenuActionElement([
//      'label' => 'admin.entities.appSettings.namePlural',
//      'route' => 'bazookas_api_framework_app_settings_admin',
//      'iconClass' => 'fa fa-gears',
//      'roles' => [Roles::ROLE_SUPER_ADMIN],
//    ]));

    // add it to the elements array
//    $this->elements[] = $container;
  }
}
