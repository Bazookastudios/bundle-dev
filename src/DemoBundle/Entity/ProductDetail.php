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

}
