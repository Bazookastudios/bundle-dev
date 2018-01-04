<?php
namespace DemoBundle\Twig;

use Bazookas\AdminBundle\AdminElements\Elements\Actions\MenuActions\MenuActionElement;
use Bazookas\AdminBundle\Twig\Base\BaseAdminMenuExtension;
use Bazookas\CommonBundle\Security\Roles;
use Bazookas\CronBundle\Menu\CronMenuTrait;
use Bazookas\MediaBundle\Menu\MediaMenuTrait;
use Symfony\Component\HttpFoundation\Request;

class AdminMenuExtension extends BaseAdminMenuExtension
{

  use CronMenuTrait;
  use MediaMenuTrait;

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

    $this->addMediaBundleMenuItems();
    $this->addAdminSettingsMenu();
  }

}
