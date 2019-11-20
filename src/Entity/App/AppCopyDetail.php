<?php

namespace App\Entity\App;

use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Entity\Traits\AccessControlTrait;
use Bazookas\CommonBundle\Entity\Interfaces\EntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nitro\AppCopyBundle\Entity\Interfaces\AppCopyDetailInterface;
use Nitro\AppCopyBundle\Entity\Traits\AppCopyDetailTrait;
use Ramsey\Uuid\Uuid;
use function get_class;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="unique_locale", columns={"detail_parent_id", "locale"})
 *     }
 * )
 * @ORM\HasLifecycleCallbacks
 */
class AppCopyDetail implements AppCopyDetailInterface, EntityInterface, TimestampableInterface, AccessControlInterface
{
    use AppCopyDetailTrait;
    use TimestampableTrait;
    use AccessControlTrait;

    /**
     * AppCopyDetail constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
        $this->created = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        $this->modified = new DateTimeImmutable('now', new DateTimeZone('UTC'));
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
