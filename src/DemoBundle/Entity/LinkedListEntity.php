<?php

namespace DemoBundle\Entity;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Bazookas\CommonBundle\Entity\Interfaces\LinkedListEntityInterface;
use Bazookas\CommonBundle\Entity\Traits\LinkedListEntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Bazookas\CommonBundle\Entity\Interfaces\EntityDetailParentInterface;
use Bazookas\CommonBundle\Entity\Traits\DetailParentTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\LinkedListRepository")
 * @ORM\HasLifecycleCallbacks
 */
class LinkedListEntity extends BaseEntity implements EntityDetailParentInterface, LinkedListEntityInterface
{

  use DetailParentTrait;
  use LinkedListEntityTrait;

  /**
   * @ORM\OneToMany(targetEntity="LinkedListEntityDetail", mappedBy="detailParent", cascade={"persist", "remove"},
   *   orphanRemoval=true)
   * @var Collection
   */
  private $details;

  /**
   * @ORM\OneToOne(targetEntity="DemoBundle\Entity\LinkedListEntity", cascade={"persist"})
   * @var LinkedListEntityInterface
   */
  protected $next;

  /**
   * @ORM\OneToOne(targetEntity="DemoBundle\Entity\LinkedListEntity", cascade={"persist"})
   * @var LinkedListEntityInterface
   */
  protected $previous;

  /**
   * LinkedListEntity constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->details = new ArrayCollection();
  }

}
