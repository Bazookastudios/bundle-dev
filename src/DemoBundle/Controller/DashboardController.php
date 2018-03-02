<?php

namespace DemoBundle\Controller;

use Bazookas\AdminBundle\AdminElements\Containers\BreadcrumbContainer;
use Bazookas\AdminBundle\AdminElements\Containers\DivContainer;
use Bazookas\AdminBundle\AdminElements\Containers\FlippablePanelContainer;
use Bazookas\AdminBundle\AdminElements\Containers\RowContainer;
use Bazookas\AdminBundle\AdminElements\Elements\AlertElement;
use Bazookas\AdminBundle\AdminElements\Elements\BreadcrumbElement;
use Bazookas\AdminBundle\AdminElements\Elements\CalendarElement;
use Bazookas\AdminBundle\AdminElements\Elements\ErrorElement;
use Bazookas\AdminBundle\AdminElements\Elements\GraphElement;
use Bazookas\AdminBundle\AdminElements\Elements\ImageElement;
use Bazookas\AdminBundle\AdminElements\Elements\ListGroupElement;
use Bazookas\AdminBundle\AdminElements\Elements\MenuOverviewElement;
use Bazookas\AdminBundle\AdminElements\Elements\ProfileElement;
use Bazookas\AdminBundle\AdminElements\Elements\TextElement;
use Bazookas\AdminBundle\Controller\Base\BaseAdminActionController;
use Bazookas\AdminBundle\Dashboard\Containers\ListContainer;
use Bazookas\AdminBundle\Entity\CMSUser;
use Bazookas\AdminBundle\PageBuilder\GenericPageBuilder;
use DemoBundle\Security\Roles;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends BaseAdminActionController
{
  //Set the default action to the dashboard action
  const ACTION_DEFAULT = self::ACTION_DASHBOARD;

  public function __construct() {
    parent::__construct();

    $this->builders = [
      self::ACTION_DASHBOARD => GenericPageBuilder::class
    ];
  }

  public function modifyDashboardBuilder(Request $request, GenericPageBuilder $builder) {
    // add example admin elements

    // ---- breadcrumb element ----
    $breadcrumbs = [
      new BreadcrumbElement([], [
        'route' => 'bazookas_admin_homepage',
        'label' => 'Admin'
      ]),
      new BreadcrumbElement([], [
        'route' => 'bazookas_admin_homepage',
        'label' => 'Current page'
      ])
    ];

    // create a container to render all breadcrumbs in a nice list
    $builder->addElement(new BreadcrumbContainer($breadcrumbs));

    // a row of items
    $builder->addElement(new RowContainer([

      new DivContainer([
        // simple alert element
        new AlertElement([], [
          'message' => 'This is an example of an alert element',
          'type' => AlertElement::TYPE_INFO,
          'colClass' => 'col-md-4',
        ]),

        new ErrorElement([], [
          'label' => 'Example error element',
        ]),

        $this->getExampleGraphElement(),

        new ListGroupElement([], [
          'navName' => 'Nav name',
          'content' => [
            'Header 1' => 'Lorem ipsum dolor sit amet consectetuor.',
            'Header 2' => 'Content 2',
          ],
          'class' => 'mar-top'
        ])

      ],['colClass' => 'col-md-4']),

      // calendar element
      new CalendarElement([], ['data' => [
        [
          'date' => new \DateTime(),
          'label' => 'an event',
          'colorClass' => 'success',
          'link' => ''
        ]
      ], 'colClass' => 'col-md-8'])
    ]));

    $builder->addElement($this->getExampleProfileElement());

    $builder->addElement(new MenuOverviewElement());

    return $builder;
  }

  private function getExampleGraphElement() {
    $graphTitle = 'Example pie chart';

    $dataDefinition = GraphElement::generateDefaultDataDefinition(GraphElement::TYPE_PIE);
    $dataDefinition['datasets'][0]['data'] = [10,20,30,40];
    $dataDefinition['datasets'][0]['label'] = $graphTitle;
    $dataDefinition['labels'] = ['ten', 'twenty', 'thirty', 'forty'];


    $graph = new GraphElement([], [
      'type' => GraphElement::TYPE_PIE,
      'data' => $dataDefinition,
      'class' => 'canvas-responsive js-graph bg-light',
      'options' => [
        'title' => [
          'display' => true,
          'text' => $graphTitle
        ],
        'tooltips' => [
          'callbacks' => [
            'label' => 'percentageTooltip'
          ]
        ],
        'animation' => [
          'onComplete' => 'addPercentageToSegment',
          'onProgress' => 'addPercentageToSegment',
        ],
        'hover' => [
          'animationDuration' => 0,
        ],
      ]
    ]);

    $graph2 = new GraphElement([], [
      'type' => GraphElement::TYPE_BAR,
      'data' => $dataDefinition,
      'class' => 'canvas-responsive js-graph bg-light',
      'options' => [
        'title' => [
          'display' => true,
          'text' => $graphTitle
        ],
        'tooltips' => [
          'callbacks' => [
            'label' => 'percentageTooltip'
          ]
        ],
        'animation' => [
          'onComplete' => 'addPercentageToSegment',
          'onProgress' => 'addPercentageToSegment',
        ],
        'hover' => [
          'animationDuration' => 0,
        ],
      ]
    ]);

    return new FlippablePanelContainer([
      $graph, $graph2
    ],[
      'icon2' => 'fa-bar-chart',
      'class' => 'mar-all',
    ]);
  }

  private function getExampleProfileElement() {
    /**
     * @var CMSUser
     */
    $user = $this->getUser();
    return new ProfileElement(
      [
        new ListContainer(
          [
            new TextElement([], [
              'value' => '10',
              'label' => 'Story mode',
              'colClass' => 'col-xs-4 pad-all',
            ]),
            new TextElement([], [
              'value' => 5,
              'label' => 'Current tier',
              'colClass' => 'col-xs-4 pad-all',
            ]),
            new TextElement([], [
              'value' => 651312,
              'label' => 'Rank score',
              'colClass' => 'col-xs-4 pad-all',
            ]),
          ]
        ),
        new ListContainer(
          [
            new TextElement([], [
              'value' => '32',
              'label' => 'admin.entities.appUser.fields.rank',
              'colClass' => 'col-xs-4 pad-all',
            ]),
            new TextElement([], [
              'value' => '999',
              'label' => 'admin.entities.appUser.fields.gamesPlayed',
              'colClass' => 'col-xs-4 pad-all',
            ]),
          ]
        ),
      ],
      [
        'label' => 'Example profile',
        'image' => new ImageElement([], [
          'src' => $user->getAvatarUrl(),
          'class' => 'img-md img-circle mar-btm'
        ]),
        'name' => $user->getUsername(),
        'role' => null,
      ]
    );
  }

  /**
   * @inheritDoc
   */
  protected function getEntityClass()
  {
    return null;
  }

  protected function hasAccess($action)
  {
    return $this->isGranted(Roles::ROLE_EXAMPLE_ADMIN);
  }


}
