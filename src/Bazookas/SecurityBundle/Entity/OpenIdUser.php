<?php

namespace Bazookas\SecurityBundle\Entity;

use Bazookas\SecurityBundle\Entity\Base\BaseUser;
use Bazookas\SecurityBundle\Entity\Interfaces\OpenIdAuthenticatableInterface;
use Bazookas\SecurityBundle\Entity\Traits\OpenIdAuthenticatableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\MappedSuperclass
 */
class OpenIdUser extends BaseUser implements OpenIdAuthenticatableInterface {

  use OpenIdAuthenticatableTrait;

}
