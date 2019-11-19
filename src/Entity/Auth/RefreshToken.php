<?php

namespace App\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nitro\TokenAuthenticationBundle\Entity\Interfaces\RefreshTokenInterface;
use Nitro\TokenAuthenticationBundle\Entity\Traits\TokenTrait;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 *
 * Class RefreshToken
 * @package Entity\Auth
 */
class RefreshToken implements RefreshTokenInterface
{
    use TokenTrait;

    /**
     * AccessToken constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
    }
}
