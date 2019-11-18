<?php

namespace App\Entity\Auth;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nitro\TokenAuthenticationBundle\Entity\Interfaces\ClientInterface;
use Nitro\TokenAuthenticationBundle\Entity\Traits\ClientTrait;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 *
 * Class Client
 * @package Entity\Auth
 */
class Client implements ClientInterface
{
    use ClientTrait;

    /**
     * Client constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
    }
}
