<?php
namespace APIBundle\Entity;

use Bazookas\APIFrameworkBundle\Entity\OAuth2Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class OAuth2Client extends BaseClient
{
  public function __construct()
  {
    parent::__construct();
  }
}
