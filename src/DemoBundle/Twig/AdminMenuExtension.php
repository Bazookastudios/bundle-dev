<?php

namespace DemoBundle\Twig;

use Bazookas\AdminBundle\AdminElements\Elements\Actions\MenuActions\MenuActionElement;
use Bazookas\AdminBundle\Twig\Base\BaseAdminMenuExtension;
use Bazookas\CommonBundle\Security\Roles;
use Bazookas\MediaBundle\Menu\MediaMenuTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;

/**
 * Class AdminMenuExtension
 * @package DemoBundle\Twig
 */
class AdminMenuExtension extends BaseAdminMenuExtension
{
    //  use CronMenuTrait;
    use MediaMenuTrait;

    //  use APIFrameworkMenuTrait;

    /**
     * @param Request $request
     *
     * @throws ExceptionInterface
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

        $this->addMediaBundleMenuItems(true, true);
        $this->addAdminSettingsMenu();
    }
}
