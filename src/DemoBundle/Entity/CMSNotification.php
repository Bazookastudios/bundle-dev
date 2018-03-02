<?php

namespace DemoBundle\Entity;

use Bazookas\AdminBundle\Entity\CMSUser;
use Bazookas\NotificationBundle\Entity\Interfaces\CMSNotificationInterface;
use Bazookas\NotificationBundle\Entity\Traits\CMSNotificationTrait;
use DemoBundle\Entity\Base\BaseNotification;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bazookas\NotificationBundle\Repository\Base\BaseCMSNotificationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CMSNotification extends BaseNotification implements CMSNotificationInterface
{

  use CMSNotificationTrait;

  /**
   * @ORM\ManyToOne(targetEntity="Bazookas\AdminBundle\Entity\CMSUser")
   * @var CMSUser
   */
  protected $user;
}
