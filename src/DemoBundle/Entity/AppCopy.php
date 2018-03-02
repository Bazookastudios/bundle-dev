<?php
namespace DemoBundle\Entity;

use Bazookas\APIFrameworkBundle\Entity\Base\BaseAppCopy;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(
 *   repositoryClass="Bazookas\APIFrameworkBundle\Repository\AppCopyAdminRepository"
 * )
 * @ORM\HasLifecycleCallbacks
 */
class AppCopy extends BaseAppCopy
{

  /**
   * @var ArrayCollection<AppCopyDetail>
   * @ORM\OneToMany(targetEntity="AppCopyDetail", mappedBy="detailParent", cascade={"all"})
   */
  protected $details;

}
