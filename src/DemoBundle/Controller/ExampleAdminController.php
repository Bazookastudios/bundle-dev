<?php

namespace DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bazookas\AdminBundle\Controller\ListBaseController;
use Bazookas\AdminBundle\Util\ListConfigurator;
use DemoBundle\Form\ExampleAdminType;

class ExampleAdminController extends ListBaseController
{

  function __construct() {
    // make sure parent construct is called!
    parent::__construct();

    $this->config->entity = 'DemoBundle:Example';
    $this->config->entityName = 'admin.entities.example.name';

    // $this->config->addField('property', 'table-header', 'sortable', 'td class', 'template');
    $this->config->addField('published', 'admin.entities.example.fields.published');
    $this->config->addField('title', 'admin.entities.example.fields.title');

    $this->config->setForm('DemoBundle\Form\ExampleAdminType');
  }

  protected function checkAccess($_action, $_id) {
    // when returning false on any action, there is no real need to set these
    // these are only usefull for showing/hiding the buttons
    // $this->config->setAccess(self::ACTION_ADD, false);
    // $this->config->setAccess(self::ACTION_EDIT, false);
    // $this->config->setAccess(self::ACTION_REMOVE, false);
    return $this->isGranted('ROLE_SUPER_ADMIN');
  }

}
