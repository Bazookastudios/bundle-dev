<?php

namespace DemoBundle\Entity\Base;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Bazookas\NotificationBundle\Entity\Interfaces\NotificationInterface;
use DemoBundle\Security\Roles;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\Entity(repositoryClass="Bazookas\NotificationBundle\Repository\Base\BaseNotificationRepository")
 * @ORM\Table(name="notifications")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\HasLifecycleCallbacks
 */
class BaseNotification extends BaseEntity implements NotificationInterface
{

  public const DEFAULT_REQUIRED_ROLE = Roles::ROLE_CMS_USER;

  /**
   * Unmapped field to be used as the discriminator by doctrine
   * @var string
   */
  protected $type;

  /**
   * @return string
   */
  public function getType(): string
  {
    return $this->type;
  }

  /**
   * @param string $type
   * @return $this
   */
  public function setType(string $type)
  {
    $this->type = $type;

    return $this;
  }
}
