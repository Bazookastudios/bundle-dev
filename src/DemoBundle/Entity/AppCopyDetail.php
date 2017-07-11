<?php
namespace DemoBundle\Entity;

use Bazookas\APIFrameworkBundle\Entity\Base\BaseAppCopyDetail;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class AppCopyDetail extends BaseAppCopyDetail
{

  /**
   * @var AppCopy $detailParent
   * @ORM\ManyToOne(targetEntity="AppCopy", inversedBy="details")
   * @ORM\JoinColumn(name="key_string", referencedColumnName="key_string")
   */
  protected $detailParent;

}
