<?php
namespace APIBundle\Entity;

use Bazookas\APIFrameworkBundle\Entity\OAuth2AccessToken as BaseAccessToken;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class OAuth2AccessToken extends BaseAccessToken
{

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
