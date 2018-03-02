<?php

namespace Bazookas\SecurityBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait OpenIdAuthenticatableTrait
{
  /**
   * @ORM\Column(type="string")
   */
  protected $oid;

  public function getOid() {
    return $this->oid;
  }

  public function setOid($openId) {
    $this->oid = $openId;
    return $this;
  }

}
