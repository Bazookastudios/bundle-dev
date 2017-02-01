<?php

namespace DemoBundle\Entity;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Temp extends BaseEntity {

}
