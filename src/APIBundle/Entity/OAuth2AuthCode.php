<?php
namespace APIBundle\Entity;

use Bazookas\APIFrameworkBundle\Entity\OAuth2AuthCode as BaseAuthCode;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class OAuth2AuthCode extends BaseAuthCode
{
}
