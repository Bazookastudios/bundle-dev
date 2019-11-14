<?php

namespace App\Twig;

use Bazookas\AdminBundle\AdminElements\Containers\MenuContainer;
use Bazookas\AdminBundle\AdminElements\Elements\Actions\MenuActions\MenuActionElement;
use Bazookas\AdminBundle\Security\Roles;
use Bazookas\AdminBundle\Twig\Base\BaseAdminMenuExtension;
use Bazookas\MediaBundle\Menu\MediaMenuTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;
use Twig\Extension\ExtensionInterface;

/**
 * Class AdminMenuExtension
 * @package App\Twig
 */
class AdminMenuExtension extends BaseAdminMenuExtension implements ExtensionInterface
{
    use MediaMenuTrait;

    /**
     * @param Request $request
     *
     * @throws ExceptionInterface
     */
    protected function createMenu(Request $request): void
    {
        //Add menu header
        $this->addMenuHeader();

        //Add project menu items
        $this->elements[] = $this->createFactsMenuItem();


        // Add (super) admin items
        $this->elements[] = $this->createMobileAppMenuItems();
        $this->addMediaBundleMenuItems(true, true);
        $this->addAdminSettingsMenu();
    }

    /**
     * @return MenuContainer
     * @throws ExceptionInterface
     */
    private function createMobileAppMenuItems(): MenuContainer
    {
        return new MenuContainer([
            'label' => 'admin.menu.containers.mobileApp',
            'roles' => [Roles::ROLE_ADMIN, Roles::ROLE_SUPER_ADMIN],
            'iconClass' => 'ti-mobile',
            'children' => [
                new MenuActionElement([
                    'label' => 'admin.entities.appCopy.namePlural',
                    'route' => 'bazookas_api_framework_app_copy_admin',
                    'iconClass' => 'fa fa-language',
                    'roles' => [Roles::ROLE_ADMIN],
                ]),
                new MenuActionElement([
                    'label' => 'admin.entities.appSettings.namePlural',
                    'route' => 'bazookas_api_framework_app_settings_admin',
                    'iconClass' => 'fa fa-gears',
                    'roles' => [Roles::ROLE_ADMIN, Roles::ROLE_SUPER_ADMIN],
                ]),
                new MenuActionElement([
                    'label' => 'admin.entities.appLog.namePlural',
                    'route' => 'bazookas_api_framework_app_log_admin',
                    'iconClass' => 'fa fa-files-o',
                    'roles' => [Roles::ROLE_SUPER_ADMIN],
                ]),
                new MenuActionElement([
                    'label' => 'admin.entities.device.namePlural',
                    'route' => 'bazookas_api_framework_device_admin',
                    'iconClass' => 'ti-mobile',
                    'roles' => [Roles::ROLE_SUPER_ADMIN],
                ]),
            ],
        ]);
    }

    /**
     * @return MenuActionElement
     *
     * @throws ExceptionInterface
     */
    private function createFactsMenuItem(): MenuActionElement
    {
        return new MenuActionElement([
            'label' => 'admin.entities.fact.namePlural',
            'route' => 'admin_facts',
            'iconClass' => 'fa fa-book',
            'roles' => [Roles::ROLE_ADMIN],
        ]);
    }
}
