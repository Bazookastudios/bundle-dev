<?php
namespace DemoBundle\Entity;

use Bazookas\AdminBundle\Entity\Interfaces\Notification\CMSNotificationInterface;
use Bazookas\AdminBundle\Entity\Traits\Notification\CMSNotificationTrait;
use Doctrine\ORM\Mapping as ORM;
use DemoBundle\Entity\Base\BaseNotification;

/**
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\CMSNotificationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CMSNotification extends BaseNotification implements CMSNotificationInterface {

  use CMSNotificationTrait;

}
