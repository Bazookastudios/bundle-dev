<?php

namespace DemoBundle\Controller;

use Bazookas\AdminBundle\Controller\Base\DashboardBaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends DashboardBaseController
{
  function __construct() {
    // make sure parent construct is called!
    parent::__construct();

    $this->config->setTitle('admin.views.generalStats.name');
  }


  protected function hasAccess() {
    return $this->isGranted('ROLE_ADMIN');
  }

  protected function buildPage(Request $request) {
    $dataService = $this->get('DemoBundle.Services.DashboardDataService');
    $statsContainer = $dataService->getMainDashboard($request->getLocale());

    $this->config
      ->addElement($statsContainer)
    ;
  }

}
