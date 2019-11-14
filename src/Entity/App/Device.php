<?php

namespace App\Entity\App;

use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Entity\Traits\AccessControlTrait;
use Bazookas\APIFrameworkBundle\Entity\Interfaces\DeviceInterface;
use Bazookas\APIFrameworkBundle\Entity\Traits\DeviceTrait;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\EntityTrait;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\App\DeviceRepository")
 * @UniqueEntity(fields={"name"})
 * @ORM\HasLifecycleCallbacks
 */
class Device implements AccessControlInterface, DeviceInterface, TimestampableInterface
{
    use AccessControlTrait;
    use DeviceTrait;
    use EntityTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @var string
     */
    private $id;

    /**
     * Device constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
        $this->created = new DateTime();
        $this->modified = new DateTime();
        $this->logs = new ArrayCollection();
    }
}
