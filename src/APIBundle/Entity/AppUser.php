<?php

namespace APIBundle\Entity;

use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Entity\Traits\AccessControlTrait;
use Bazookas\AdminBundle\Security\Roles;
use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Bazookas\CommonBundle\Entity\Interfaces\EntityInterface;
use Bazookas\CommonBundle\Entity\Interfaces\TimestampableInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Bazookas\CommonBundle\Entity\Base\BaseUser;
use Bazookas\CommonBundle\Entity\Traits;
use Bazookas\CommonBundle\Entity\Interfaces\LocalisedEntityInterface;

/**
 * @ORM\Table(name="app_user")
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"email"},
 *     message="email.notUnique"
 * )
 * @UniqueEntity(
 *     fields={"facebookId"},
 *     message="facebookId.notUnique"
 * )
 * @ORM\HasLifecycleCallbacks
 */
class AppUser implements EntityInterface, AccessControlInterface, TimestampableInterface
{

  use Traits\EntityTrait;
  use Traits\TimestampableTrait;
  use Traits\LocalisedTrait;
  use Traits\UserTrait;
  use AccessControlTrait;

  public const DEFAULT_REQUIRED_ROLE = Roles::ROLE_ADMIN;

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="string")
   * @Assert\NotBlank
   */
  private $firstName;

  /**
   * @ORM\Column(type="string")
   * @Assert\NotBlank
   */
  private $surname;

  /**
   * @ORM\Column(type="datetime")
   * @Assert\NotBlank
   * @Assert\Date
   */
  private $birthDate;

  /**
   * @ORM\Column(type="string")
   * @Assert\NotBlank
   * @Assert\Email
   */
  private $email;

  /**
   * @ORM\Column(type="string", length=2, options={"fixed" = true})
   * @Assert\NotBlank
   * @Assert\Choice({"M", "F"})
   */
  private $gender;

  /**
   * @ORM\OneToOne(targetEntity="Bazookas\MediaBundle\Entity\Image", cascade="all")
   */
  private $image;

  /**
   * @ORM\OneToMany(targetEntity="OAuth2AccessToken", mappedBy="user", cascade="remove")
   */
  private $accessTokens;

  /**
   * @ORM\OneToMany(targetEntity="OAuth2RefreshToken", mappedBy="user", cascade="remove")
   */
  private $refreshTokens;

  /**
   * AppUser constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->roles = ['ROLE_APP_USER'];
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function setFirstName($name) {
    $this->firstName = $name;

    return $this;
  }

  public function getSurname() {
    return $this->surname;
  }

  public function setSurname($name) {
    $this->surname = $name;

    return $this;
  }

  public function getBirthDate() {
    return $this->birthDate;
  }

  public function setBirthDate($date) {
    if (!$this->compareEqualDates($this->birthDate, $date)) {
      $this->birthDate = $date;
    }
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;

    return $this;
  }

  public function getGender() {
    return $this->gender;
  }

  public function setGender($gender) {
    $this->gender = strtoupper($gender);

    return $this;
  }

  public function getImage() {
    return $this->image;
  }

  public function setImage($image) {
    $this->image = $image;

    return $this;
  }

  public function getPlainPassword() {
    return $this->plainPassword;
  }

  public function setPlainPassword($password) {
    $this->plainPassword = $password;

    return $this;
  }

  public function getAccessTokens() {
    return $this->accessTokens;
  }

  public function setAccessTokens($accessTokens) {
    $this->accessTokens = $accessTokens;

    return $this;
  }

  public function getRefreshTokens() {
    return $this->refreshTokens;
  }

  public function setRefreshTokens($refreshTokens) {
    $this->refreshTokens = $refreshTokens;

    return $this;
  }

  /**
   * @param string $locale
   * @return string
   */
  public function toHumanReadable(string $locale = 'nl'): string {
    return 'Gebruiker {username: ' . $this->getUsername() . '}';
  }
}
