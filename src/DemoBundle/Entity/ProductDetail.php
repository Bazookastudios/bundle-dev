<?php

namespace DemoBundle\Entity;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Bazookas\CommonBundle\Entity\Interfaces\CloneableEntityInterface;
use Bazookas\CommonBundle\Entity\Traits\CloneableEntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Bazookas\CommonBundle\Entity\Interfaces\EntityDetailInterface;
use Bazookas\CommonBundle\Entity\Interfaces\LocalisedEntityInterface;
use Bazookas\CommonBundle\Entity\Traits\DetailTrait;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class ProductDetail extends BaseEntity implements EntityDetailInterface, CloneableEntityInterface {

  use DetailTrait;
  use CloneableEntityTrait;
  
  /**
   * @ORM\ManyToOne(targetEntity="Product", inversedBy="details")
   * @var Product $detailParent
   */
  private $detailParent;

  /**
   * @ORM\Column(type="string")
   * @var string
   */
  private $title;

  /**
   * @ORM\Column(type="string")
   * @var string
   */
  private $choiceField;

  /**
   * @ORM\Column(type="datetime")
   * @var \DateTime
   */
  private $sendDateTime;

  /**
   * @return string|null
   */
  public function getTitle(): ?string
  {
    return $this->title;
  }

  /**
   * @param string $title
   * @return ProductDetail
   */
  public function setTitle(string $title): ProductDetail
  {
    $this->title = $title;

    return $this;
  }

  /**
   * @return string|null
   */
  public function getChoiceField(): ?string
  {
    return $this->choiceField;
  }

  /**
   * @param string $choiceField
   * @return ProductDetail
   */
  public function setChoiceField(string $choiceField): ProductDetail
  {
    $this->choiceField = $choiceField;

    return $this;
  }

  /**
   * @return \DateTime|null
   */
  public function getSendDateTime(): ?\DateTime
  {
    return $this->sendDateTime;
  }

  /**
   * @param \DateTime $sendDateTime
   * @return ProductDetail
   */
  public function setSendDateTime(\DateTime $sendDateTime): ProductDetail
  {
    $this->sendDateTime = $sendDateTime;

    return $this;
  }

}
