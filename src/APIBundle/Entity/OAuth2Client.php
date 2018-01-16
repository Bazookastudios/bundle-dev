<?php
namespace APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\Client;

/**
 * @ORM\Entity
 */
class OAuth2Client extends Client
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   * @var integer
   */
  protected $id;

  public function __construct()
  {
    parent::__construct();
  }
}
