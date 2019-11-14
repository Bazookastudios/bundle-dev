<?php

namespace App\Entity\App;

use Bazookas\APIFrameworkBundle\Entity\Base\BaseAppCopyDetail;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="unique_locale", columns={"key_string", "locale"})
 *     }
 * )
 * @ORM\HasLifecycleCallbacks
 */
class AppCopyDetail extends BaseAppCopyDetail
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\App\AppCopy", inversedBy="details")
     * @ORM\JoinColumn(name="key_string", referencedColumnName="key_string", nullable=false)
     * @var AppCopy $detailParent
     */
    protected $detailParent;
}
