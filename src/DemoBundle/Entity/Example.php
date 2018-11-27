<?php

namespace DemoBundle\Entity;

use Bazookas\AdminBundle\Entity\Interfaces\AuditableInterface;
use Bazookas\AdminBundle\Entity\Traits\AuditableTrait;
use Bazookas\AdminBundle\Security\Roles;
use Bazookas\CommonBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\CommonBundle\Entity\Interfaces\CloneableEntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\EntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Bazookas\CommonBundle\Entity\Traits\CloneableEntityTrait;
use Bazookas\MediaBundle\Entity\Image;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Bazookas\CommonBundle\Entity\Traits;

/**
 * Example
 *
 * @ORM\Table(name="example")
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\ExampleRepository")
 */
class Example implements EntityInterface, AccessControlInterface, TimestampableInterface, CloneableEntityInterface, AuditableInterface
{

  use Traits\EntityTrait;
  use Traits\AccessControlTrait;
  use Traits\TimestampableTrait {
    Traits\TimestampableTrait::__construct as TimestampableTraitConstruct;
  }
  use CloneableEntityTrait;
  use AuditableTrait;

  //Default role for access control
  public const DEFAULT_REQUIRED_ROLE = Roles::ROLE_SUPER_ADMIN;

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * Example constructor.
   * @throws \Exception
   */
  public function __construct() {
    $this->TimestampableTraitConstruct();
    $this->multipleImages = new ArrayCollection();
  }

  /**
   * @var string
   * @ORM\Column(type="string", length=255)
   */
  private $title;

  /**
   * @var boolean
   * @ORM\Column(type="boolean")
   */
  private $published = false;

  /**
   * @var Image
   * @ORM\ManyToOne(targetEntity="\Bazookas\MediaBundle\Entity\Image")
   */
  private $singleImage;

  /**
   * @var Image
   * @ORM\ManyToMany(targetEntity="\Bazookas\MediaBundle\Entity\Image")
   */
  private $multipleImages;

  /**
   * @ORM\OneToMany(targetEntity="Example", mappedBy="parent")
   */
  protected $children;

  /**
   * @ORM\ManyToOne(targetEntity="Example", inversedBy="children")
   */
  protected $parent;


  /**
   * Set title
   *
   * @param string $title
   *
   * @return Example
   */
  public function setTitle($title) {
    $this->title = $title;

    return $this;
  }

  /**
   * Get title
   *
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @return boolean
   */
  public function isPublished() {
    return $this->published;
  }

  public function getPublished() {
    return $this->published;
  }

  /**
   * @param boolean $published
   * @return Example
   */
  public function setPublished($published) {
    $this->published = $published;

    return $this;
  }


  /**
   * @return Image
   */
  public function getSingleImage() {
    return $this->singleImage;
  }

  /**
   * @param Image $singleImage
   * @return Example
   */
  public function setSingleImage($singleImage) {
    $this->singleImage = $singleImage;

    return $this;
  }

  /**
   * @return mixed
   */
  public function getMultipleImages() {
    return $this->multipleImages;
  }

  /**
   * @param mixed $multipleImages
   * @return Example
   */
  public function setMultipleImages($multipleImages) {
    $this->multipleImages = $multipleImages;

    return $this;
  }

  public function addMultipleImage($image) {
    $this->multipleImages->add($image);

    return $this;
  }

  public function removeMultipleImage($image) {
    $this->multipleImages->removeElement($image);

    return $this;
  }

  /**
   * @inheritdoc
   * @return array
   */
  public static function getViewableLayout(): array {
    return [
      'title' => 'string',
      'published' => 'boolean',
    ];
  }
}

