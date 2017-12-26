<?php
namespace DemoBundle\Entity;

use Bazookas\AdminBundle\Entity\Interfaces\AuditableInterface;
use Bazookas\AdminBundle\Entity\Interfaces\VersionableInterface;
use Bazookas\AdminBundle\Entity\Traits\AuditableTrait;
use Bazookas\AdminBundle\Entity\Traits\VersionableTrait;
use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Bazookas\CommonBundle\Entity\Interfaces\CloneableEntityInterface;
use Bazookas\CommonBundle\Entity\Traits\CloneableEntityTrait;
use Bazookas\MediaBundle\Entity\Image;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Example
 *
 * @ORM\Table(name="example")
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\ExampleRepository")
 */
class Example extends BaseEntity implements CloneableEntityInterface, VersionableInterface
{
  use CloneableEntityTrait;
//  use AuditableTrait;
  use VersionableTrait;

  public function __construct()
  {
    parent::__construct();
    $this->entityId = (new \DateTime())->getTimestamp();
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
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get title
   *
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * @return boolean
   */
  public function isPublished()
  {
    return $this->published;
  }

  public function getPublished() {
    return $this->published;
  }

  /**
   * @param boolean $published
   * @return Example
   */
  public function setPublished($published)
  {
    $this->published = $published;
    return $this;
  }


  /**
   * @return Image
   */
  public function getSingleImage()
  {
    return $this->singleImage;
  }

  /**
   * @param Image $singleImage
   * @return Example
   */
  public function setSingleImage($singleImage)
  {
    $this->singleImage = $singleImage;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMultipleImages()
  {
    return $this->multipleImages;
  }

  /**
   * @param mixed $multipleImages
   * @return Example
   */
  public function setMultipleImages($multipleImages)
  {
    $this->multipleImages = $multipleImages;
    return $this;
  }

  public function addMultipleImage($image)
  {
    $this->multipleImages->add($image);
    return $this;
  }

  public function removeMultipleImage($image)
  {
    $this->multipleImage->removeElement($image);
    return $this;
  }

  /**
   * @inheritdoc
   * @return array
   */
  public function getViewableLayout(): array
  {
    return [
      'title' => 'string',
      'published' => 'boolean',
    ];
  }
}

