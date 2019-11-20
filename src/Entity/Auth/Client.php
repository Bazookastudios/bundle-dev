<?php

namespace App\Entity\Auth;

use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
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
class Client implements ClientInterface, TimestampableInterface
{
    use ClientTrait;
    use TimestampableTrait;

    /**
     * Client constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
        $this->created = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        $this->modified = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }
}
