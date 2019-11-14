<?php

namespace App\Entity\App;

use Bazookas\AdminBundle\Security\Roles;
use Bazookas\APIFrameworkBundle\Entity\Base\BaseAppCopy;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Bazookas\APIFrameworkBundle\Repository\AppCopyAdminRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"key"})
 */
class AppCopy extends BaseAppCopy
{
    public const DEFAULT_REQUIRED_ROLE = Roles::ROLE_ADMIN;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\App\AppCopyDetail", mappedBy="detailParent", cascade={"all"})
     * @Assert\Valid
     * @var ArrayCollection<AppCopyDetail>
     */
    protected $details;
}
