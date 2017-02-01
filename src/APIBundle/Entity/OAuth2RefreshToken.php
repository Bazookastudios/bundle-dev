<?php
namespace APIBundle\Entity;

use Bazookas\APIFrameworkBundle\Entity\OAuth2RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class OAuth2RefreshToken extends BaseRefreshToken
{
  /**
   * @ORM\ManyToOne(targetEntity="AppUser", inversedBy="refreshTokens")
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
