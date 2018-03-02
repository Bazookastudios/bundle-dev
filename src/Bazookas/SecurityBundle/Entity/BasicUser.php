<?php

namespace Bazookas\SecurityBundle\Entity;

use Bazookas\SecurityBundle\Entity\Base\BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\MappedSuperclass
 */
class BasicUser extends BaseUser {

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $password;

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $salt;

  /**
   * @ORM\Column(type="array", nullable=true)
   */
  protected $roles;

  public function __construct($username, $password = null, $salt = null, array $roles = [])
  {
    parent::__construct($username);
    $this->password = $password;
    $this->salt = $salt;
    $this->roles = $roles;
  }

  public function getRoles()
  {
    return $this->roles;
  }

  public function setRoles($roles) {
    $this->roles = $roles;
    return $this;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
    return $this;
  }

  public function getSalt()
  {
    return $this->salt;
  }

  public function setSalt($salt) {
    $this->salt = $salt;
    return $this;
  }

  public function eraseCredentials()
  {
    //Not applicable to a base user
  }

  public function isEqualTo(UserInterface $user)
  {
    if (!$user instanceof BaseUser) {
      return false;
    }

    if ($this->password !== $user->getPassword()) {
      return false;
    }

    if ($this->salt !== $user->getSalt()) {
      return false;
    }

    if ($this->username !== $user->getUsername()) {
      return false;
    }

    return true;
  }
}
