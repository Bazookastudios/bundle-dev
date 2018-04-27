<?php

namespace DemoBundle\Entity;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="DemoBundle\Repository\EventRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Event extends BaseEntity
{

  /**
   * @ORM\Column(type="datetime")
   * @var \DateTime|null
   */
  private $date;

  /**
   * @ORM\Column(type="string")
   * @var string|null
   */
  private $title;

  /**
   * @return \DateTime|null
   */
  public function getDate(): ?\DateTime
  {
    return $this->date;
  }

  /**
   * @param \DateTime|null $date
   * @return Event
   */
  public function setDate(?\DateTime $date): Event
  {
    $this->date = $date;

    return $this;
  }

  /**
   * @return null|string
   */
  public function getTitle(): ?string
  {
    return $this->title;
  }

  /**
   * @param null|string $title
   * @return Event
   */
  public function setTitle(?string $title): Event
  {
    $this->title = $title;

    return $this;
  }

}
