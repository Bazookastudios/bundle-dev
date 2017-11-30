<?php

namespace DemoBundle\Entity;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Bazookas\CommonBundle\Entity\Interfaces\EntityDetailParentInterface;
use Bazookas\CommonBundle\Entity\Traits\DetailParentTrait;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Product extends BaseEntity implements EntityDetailParentInterface {

  use DetailParentTrait;
  
  /**
   * @ORM\OneToMany(targetEntity="ProductDetail", mappedBy="detailParent", cascade="all", orphanRemoval=true)
   * @var ProductDetail[]
   */
  private $details;

  public function __construct() {
    $this->details = new ArrayCollection();
    parent::__construct();
  }

}
