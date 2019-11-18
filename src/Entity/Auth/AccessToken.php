<?php

namespace App\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nitro\TokenAuthenticationBundle\Entity\Interfaces\AccessTokenInterface;
use Nitro\TokenAuthenticationBundle\Entity\Traits\AccessTokenTrait;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Auth\TokenRepository")
 *
 * Class AccessToken
 * @package Entity\Auth
 */
class AccessToken implements AccessTokenInterface
{
    use AccessTokenTrait;

    /**
     * AccessToken constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
    }
}
