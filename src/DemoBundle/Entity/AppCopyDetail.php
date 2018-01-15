<?php
namespace DemoBundle\Entity;

use Bazookas\APIFrameworkBundle\Entity\Base\BaseAppCopyDetail;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppCopyDetail
 * @package DemoBundle\Entity
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class AppCopyDetail extends BaseAppCopyDetail
{
  /**
   * @var AppCopy
   * @ORM\ManyToOne(targetEntity="DemoBundle\Entity\AppCopy", inversedBy="details")
   * @ORM\JoinColumn(name="key_string", referencedColumnName="key_string")
   */
  protected $detailParent;
}
