<?php

namespace Bazookas\SecurityBundle\Entity\Interfaces;

interface OpenIdAuthenticatableInterface
{

  public function getOid();

  public function setOid($openId);

}
