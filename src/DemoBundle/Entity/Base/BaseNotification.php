<?php
namespace DemoBundle\Entity\Base;

use Bazookas\CommonBundle\Entity\Base\BaseCMSUser;
use Doctrine\ORM\Mapping as ORM;
use \Bazookas\AdminBundle\Entity\Base\BaseNotification as AdminBaseNotification;

/**
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\Base\BaseNotificationRepository")
 * @ORM\Table(name="notifications")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\HasLifecycleCallbacks
 */
class BaseNotification extends AdminBaseNotification {

  /**
   * @var BaseCMSUser
   * @ORM\ManyToOne(targetEntity="Bazookas\AdminBundle\Entity\CMSUser")
   */
  protected $user;

}
