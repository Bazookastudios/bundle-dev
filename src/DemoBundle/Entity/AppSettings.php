<?php
namespace DemoBundle\Entity;

use Bazookas\APIFrameworkBundle\Entity\Base\BaseAppSettings;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppSettings
 * @package DemoBundle\Entity
 * @ORM\Entity(
 *   repositoryClass="Bazookas\APIFrameworkBundle\Repository\AppSettingsAdminRepository"
 * )
 */
class AppSettings extends BaseAppSettings
{

}
