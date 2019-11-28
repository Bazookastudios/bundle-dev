<?php

namespace App\Entity\Fact;

use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Entity\Traits\AccessControlTrait;
use Bazookas\CommonBundle\Entity\Interfaces\EntityDetailInterface;
use Bazookas\CommonBundle\Entity\Interfaces\EntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\DetailTrait;
use Bazookas\CommonBundle\Entity\Traits\EntityTrait;
use Bazookas\CommonBundle\Entity\Traits\TimestampableTrait;
use Bazookas\MediaBundle\Entity\Image;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FactDetail
 * @package App\Entity\Fact
 *
 * @ORM\Entity
 * @ORM\Table(
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="unique_locale", columns={"detail_parent_id", "locale"})
 *     },
 * )
 * @ORM\HasLifecycleCallbacks
 */
class FactDetail implements
    AccessControlInterface,
    EntityDetailInterface,
    EntityInterface,
    TimestampableInterface
{
    use AccessControlTrait;
    use DetailTrait;
    use EntityTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @var string
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fact\Fact",inversedBy="details")
     * @ORM\JoinColumn(nullable=false)
     * @var Fact $detailParent
     */
    private $detailParent;

    /**
     * @ORM\Column(name="fact", type="string")
     * @Assert\NotBlank
     * @Assert\Length(max="255")
     * @var string
     */
    private $fact = '';

    /**
     * @ORM\ManyToOne(targetEntity="Bazookas\MediaBundle\Entity\Image")
     * @var Image|null
     * @Assert\NotBlank
     * @Assert\Valid
     */
    private $image;

    /**
     * FactDetail constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->id = (string)Uuid::uuid4();
        $this->created = new DateTime();
        $this->modified = new DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFact(): string
    {
        return $this->fact;
    }

    /**
     * @param string $fact
     *
     * @return FactDetail
     */
    public function setFact(string $fact): FactDetail
    {
        $this->fact = $fact;

        return $this;
    }

    /**
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * @param Image|null $image
     *
     * @return FactDetail
     */
    public function setImage(?Image $image): FactDetail
    {
        $this->image = $image;

        return $this;
    }
}
