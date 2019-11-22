<?php

namespace App\Entity\App;

use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Entity\Traits\AccessControlTrait;
use Bazookas\CommonBundle\Entity\Interfaces\EntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use DateTime;
use Nitro\AppCopyBundle\Security\Roles;
use Symfony\Component\Validator\Constraints as Assert;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nitro\AppCopyBundle\Entity\Interfaces\AppCopyInterface;
use Nitro\AppCopyBundle\Entity\Traits\AppCopyTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use function get_class;

/**
 * @ORM\Entity(repositoryClass="App\Repository\App\AppCopyRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"id"})
 */
class AppCopy implements AppCopyInterface, EntityInterface, TimestampableInterface, AccessControlInterface
{
    public const DEFAULT_REQUIRED_ROLE = Roles::ROLE_COPY_ADMIN;

    use AppCopyTrait;
    use TimestampableTrait;
    use AccessControlTrait;

    /**
     * BaseAppCopy constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->details = new ArrayCollection();
        $this->created = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        $this->modified = new DateTime('now', new DateTimeZone('UTC'));
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
