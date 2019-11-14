<?php

namespace App\Twig;

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
        $this->addMediaBundleMenuItems(true, true);
        $this->addAdminSettingsMenu();
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
