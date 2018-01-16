<?php
namespace APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\AuthCode;

/**
 * @ORM\Entity
 */
class OAuth2AuthCode extends AuthCode
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   * @var integer
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="OAuth2Client")
   * @ORM\JoinColumn(nullable=false)
   * @var OAuth2Client
   */
  protected $client;
}
