<?php

namespace Bazookas\SecurityBundle\Entity\Base;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\MappedSuperclass
*/
abstract class BaseUser extends BaseEntity implements UserInterface {

  /**
  * @ORM\Column(type="string")
  */
  protected $username;

  public function __construct($username)
  {
    parent::__construct();
    $this->username = $username;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername($name) {
    $this->username = $name;
    return $this;
  }

  public function getRoles()
  {
    return array('ROLE_APP_USER');
  }

  public function getPassword()
  {
  }

  public function getSalt()
  {
  }

  public function eraseCredentials()
  {
  }
}
