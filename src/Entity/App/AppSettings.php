<?php

namespace App\Entity\App;

use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Entity\Traits\AccessControlTrait;
use Bazookas\AdminBundle\Security\Roles;
use Bazookas\CommonBundle\Entity\Interfaces\EntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nitro\AppSettingsBundle\Entity\Interfaces\AppSettingsInterface;
use Nitro\AppSettingsBundle\Entity\Traits\AppSettingsTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use function get_class;

/**
 * @ORM\Entity(repositoryClass="App\Repository\App\AppSettingsRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"id"})
 */
class AppSettings implements AppSettingsInterface, EntityInterface, TimestampableInterface, AccessControlInterface
{
    public const DEFAULT_REQUIRED_ROLE = Roles::ROLE_ADMIN;

    use AppSettingsTrait;
    use TimestampableTrait;
    use AccessControlTrait;

    /**
     * AppSettings constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->created = new DateTimeImmutable('UTC', new DateTimeZone('UTC'));
        $this->modified = new DateTime('UTC', new DateTimeZone('UTC'));
    }

    /**
     * @return bool
     */
    public function allowForceDelete(): bool
    {
        return true;
    }

    /**
     * @param string $locale
     *
     * @return array|string
     * @throws Exception
     */
    public function getLinkedEntityMessage(string $locale = 'nl')
    {
        return get_class($this).' {id: '.$this->getId().'}';
    }
}
