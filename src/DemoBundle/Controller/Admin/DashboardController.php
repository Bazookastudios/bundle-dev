<?php

namespace DemoBundle\Controller\Admin;

use Bazookas\AdminBundle\AdminElements\Containers\TabbedContainer;
use Bazookas\AdminBundle\AdminElements\Containers\TabbedPanelContainer;
use Bazookas\AdminBundle\AdminElements\Elements\TextElement;
use Bazookas\AdminBundle\Controller\Base\BaseAdminActionController;
use Bazookas\AdminBundle\PageBuilder\GenericPageBuilder;
use Bazookas\AdminBundle\Security\Roles;
use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends BaseAdminActionController
{

  public const ACTION_DEFAULT = AccessControlInterface::ACTION_DASHBOARD;

  /**
   * DashboardController constructor.
   */
  public function __construct() {
    $this->builders[AccessControlInterface::ACTION_DASHBOARD] = GenericPageBuilder::class;
  }

  /**
   * @param Request $request
   * @param GenericPageBuilder $builder
   * @return GenericPageBuilder
   * @throws \Symfony\Component\OptionsResolver\Exception\ExceptionInterface
   */
  protected function modifyDashboardBuilder(Request $request, GenericPageBuilder $builder): GenericPageBuilder {
    $tabOneOptions = [
      'label' => 'test1',
      'navName' => 'test1',
    ];
    $tabTwoOptions = [
      'label' => 'test2',
      'navName' => 'test2',
    ];

    $builder->addElement(new TabbedContainer([
      'children' => [
        new TextElement($tabOneOptions),
        new TextElement($tabTwoOptions),
      ],
      'tabOrientation' => TabbedContainer::ORIENTATION_VERTICAL,
      'tabLocation' => TabbedContainer::LOCATION_RIGHT,
    ]));
    $builder->addElement(new TabbedPanelContainer([
      'children' => [
        new TextElement($tabOneOptions),
        new TextElement($tabTwoOptions),
      ],
      'headerLabel' => 'test',
      'tabOrientation' => TabbedPanelContainer::ORIENTATION_VERTICAL,
      'tabLocation' => TabbedPanelContainer::LOCATION_LEFT,
    ]));

    return $builder;
  }

  /**
   * @return null|string the entity fully qualified class name
   */
  protected function getEntityClass(): ?string {
    return null;
  }

  /**
   * Check whether the current logged in user has access to perform the action
   * @param string $action
   * @return bool
   * @throws \LogicException
   */
  protected function hasAccess(string $action): bool {
    return $this->isGranted(Roles::ROLE_SUPER_ADMIN);
  }
}
