<?php
namespace DemoBundle\Entity;

use Bazookas\AdminBundle\Entity\Interfaces\Notification\EmailNotificationInterface;
use Bazookas\AdminBundle\Entity\Traits\Notification\EmailNotificationTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DemoBundle\Entity\Base\BaseNotification;

/**
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\EmailNotificationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class EmailNotification extends BaseNotification implements EmailNotificationInterface {

  use EmailNotificationTrait;

}
