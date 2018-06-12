<?php

namespace DemoBundle\Entity;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Bazookas\MediaBundle\Entity\Image;
use Bazookas\MediaBundle\Entity\Interfaces\MediaEntityInterface;
use Bazookas\MediaBundle\Entity\Video;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Bazookas\CommonBundle\Entity\Interfaces\EntityDetailInterface;
use Bazookas\CommonBundle\Entity\Traits\DetailTrait;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class LinkedListEntityDetail extends BaseEntity implements EntityDetailInterface
{

  use DetailTrait;

  /**
   * @ORM\ManyToOne(targetEntity="LinkedListEntity", inversedBy="details")
   * @var LinkedListEntity $detailParent
   */
  private $detailParent;

  /**
   * @ORM\Column(type="string")
   * @var string
   */
  private $title;

  /**
   * @ORM\Column(type="text")
   * @var string
   */
  private $description;

  /**
   * @ORM\ManyToOne(targetEntity="Bazookas\MediaBundle\Entity\Image")
   * @var Image
   */
  private $image;

  /**
   * @ORM\ManyToOne(targetEntity="Bazookas\MediaBundle\Entity\Video")
   * @var Video
   */
  private $video;

  /**
   * @return string
   */
  public function getTitle(): string {
    return $this->title;
  }

  /**
   * @param string $title
   * @return LinkedListEntityDetail
   */
  public function setTitle(string $title): LinkedListEntityDetail {
    $this->title = $title;

    return $this;
  }

  /**
   * @return string
   */
  public function getDescription(): string {
    return $this->description;
  }

  /**
   * @param string $description
   * @return LinkedListEntityDetail
   */
  public function setDescription(string $description): LinkedListEntityDetail {
    $this->description = $description;

    return $this;
  }

  /**
   * @return Image
   */
  public function getImage(): Image {
    return $this->image;
  }

  /**
   * @param Image $image
   * @return LinkedListEntityDetail
   */
  public function setImage(Image $image): LinkedListEntityDetail {
    $this->image = $image;

    return $this;
  }

  /**
   * @return Video
   */
  public function getVideo(): Video {
    return $this->video;
  }

  /**
   * @param Video $video
   * @return LinkedListEntityDetail
   */
  public function setVideo(Video $video): LinkedListEntityDetail {
    $this->video = $video;

    return $this;
  }

}
