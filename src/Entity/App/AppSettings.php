<?php

namespace App\Entity\App;

use Bazookas\AdminBundle\Security\Roles;
use Bazookas\APIFrameworkBundle\Entity\Base\BaseAppSettings;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Bazookas\APIFrameworkBundle\Repository\AppSettingsAdminRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"key"})
 */
class AppSettings extends BaseAppSettings
{
    public const DEFAULT_REQUIRED_ROLE = Roles::ROLE_ADMIN;
}
