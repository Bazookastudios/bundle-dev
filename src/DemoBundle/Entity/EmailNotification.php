<?php

namespace DemoBundle\Entity;

use Bazookas\AdminBundle\Entity\CMSUser;
use Bazookas\NotificationBundle\Entity\Interfaces\EmailNotificationInterface;
use Bazookas\NotificationBundle\Entity\Traits\EmailNotificationTrait;
use DemoBundle\Entity\Base\BaseNotification;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bazookas\NotificationBundle\Repository\Base\BaseEmailNotificationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class EmailNotification extends BaseNotification implements EmailNotificationInterface
{

  use EmailNotificationTrait;

  /**
   * @ORM\ManyToOne(targetEntity="Bazookas\AdminBundle\Entity\CMSUser")
   * @var CMSUser
   */
  protected $user;
}
