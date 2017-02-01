<?php

namespace DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bazookas\AdminBundle\Controller\ListBaseController;
use Bazookas\AdminBundle\Util\ListConfigurator;
use DemoBundle\Entity\Temp;
use DemoBundle\Form\TempAdminType;

class TempAdminController extends ListBaseController
{

  function __construct() {
    // make sure parent construct is called!
    parent::__construct();

    $this->config->entity = Temp::class;
    $this->config->entityName = 'admin.entities.temp.name';
    // $this->config->addField('property', 'table-header', 'sortable', 'td class', 'template');
    $this->config->addField('created', 'admin.entities.temp.fields.created');
    $this->config->addField('modified', 'admin.entities.temp.fields.modified');
    $this->config->setForm(TempAdminType::class);
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
