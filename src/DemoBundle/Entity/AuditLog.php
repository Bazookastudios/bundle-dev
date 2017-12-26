<?php
namespace DemoBundle\Entity;

use Bazookas\AdminBundle\Entity\Base\BaseAuditLog;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(
 *   repositoryClass="DemoBundle\Repository\AuditRepository"
 * )
 * @ORM\HasLifecycleCallbacks
 */
class AuditLog extends BaseAuditLog
{

}
