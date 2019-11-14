<?php

namespace App\Entity\App;

use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Entity\Traits\AccessControlTrait;
use Bazookas\APIFrameworkBundle\Entity\Interfaces\AppLogInterface;
use Bazookas\APIFrameworkBundle\Entity\Traits\AppLogTrait;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\EntityTrait;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\App\AppLogRepository")
 * @ORM\Table(indexes={
 *   @ORM\Index(name="log_identifier_idx", columns={"identifier"}),
 *   @ORM\Index(name="log_type_idx", columns={"type"})
 * })
 * @ORM\HasLifecycleCallbacks
 */
class AppLog implements AccessControlInterface, AppLogInterface, TimestampableInterface
{
    use AccessControlTrait;
    use AppLogTrait;
    use EntityTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @var string
     */
    private $id;

    /**
     * AppLog constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
        $this->created = new DateTime();
        $this->modified = new DateTime();
    }
}
