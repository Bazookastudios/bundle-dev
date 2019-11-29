<?php

namespace App\Entity\Fact;

use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Entity\Traits\AccessControlTrait;
use Bazookas\AdminBundle\Security\Roles;
use Bazookas\CommonBundle\Entity\Interfaces\EntityDetailParentInterface;
use Bazookas\CommonBundle\Entity\Interfaces\EntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\DetailParentTrait;
use Bazookas\CommonBundle\Entity\Traits\EntityTrait;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Fact
 * @package App\Entity\Fact
 *
 * @ORM\Entity(repositoryClass="App\Repository\Fact\FactRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Fact implements
    AccessControlInterface,
    EntityDetailParentInterface,
    EntityInterface,
    TimestampableInterface
{
    use AccessControlTrait;
    use DetailParentTrait;
    use EntityTrait;
    use TimestampableTrait;

    // Default role for access control
    public const DEFAULT_REQUIRED_ROLE = Roles::ROLE_ADMIN;

    /**
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @var string
     */
    private $id;

    /**
     * @ORM\OneToMany(
     *   targetEntity="App\Entity\Fact\FactDetail",
     *   mappedBy="detailParent",
     *   cascade={"persist", "remove"},
     *   orphanRemoval=true
     * )
     * @Assert\Valid
     * @var Collection
     */
    private $details;

    /**
     * Fact constructor
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
        $this->details = new ArrayCollection();
        $this->created = new DateTimeImmutable('now', new DateTimeZone('UTC'));
        $this->modified = new DateTime('now', new DateTimeZone('UTC'));
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
