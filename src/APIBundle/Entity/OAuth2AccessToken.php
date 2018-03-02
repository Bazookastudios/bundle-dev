<?php
namespace APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\AccessToken;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class OAuth2AccessToken extends AccessToken
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

  /**
   * @ORM\ManyToOne(targetEntity="AppUser", inversedBy="accessTokens")
   */
  protected $user;

  public function getUser()
  {
    return $this->user;
  }

  public function setUser(UserInterface $user)
  {
    $this->user = $user;

    return $this;
  }
}
