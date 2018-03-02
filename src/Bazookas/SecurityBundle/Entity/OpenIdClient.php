<?php

namespace Bazookas\SecurityBundle\Entity;

use Bazookas\CommonBundle\Entity\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table
 * @ORM\Entity(repositoryClass="Bazookas\SecurityBundle\Repository\OpenIdClientRepository")
 * @ORM\HasLifecycleCallbacks
 */
class OpenIdClient extends BaseEntity {

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $name;

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $issuer;

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $authorizationEndpoint;

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $tokenEndpoint;

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $endSessionEndpoint;

  /**
   * @ORM\Column(type="array", nullable=true)
   */
  private $jwtKeys;

  /**
   * @ORM\Column(type="array", nullable=true)
   */
  private $idTokenSigningAlgorithm;

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $policy;

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  public function getIssuer()
  {
    return $this->issuer;
  }

  public function setIssuer($issuer)
  {
    $this->issuer = $issuer;

    return $this;
  }

  public function getAuthorizationEndpoint()
  {
    return $this->authorizationEndpoint;
  }

  public function setAuthorizationEndpoint($authorizationEndpoint)
  {
    $this->authorizationEndpoint = $authorizationEndpoint;

    return $this;
  }

  public function getTokenEndpoint()
  {
    return $this->tokenEndpoint;
  }

  public function setTokenEndpoint($tokenEndpoint)
  {
    $this->tokenEndpoint = $tokenEndpoint;

    return $this;
  }

  public function getEndSessionEndpoint()
  {
    return $this->endSessionEndpoint;
  }

  public function setEndSessionEndpoint($endSessionEndpoint)
  {
    $this->endSessionEndpoint = $endSessionEndpoint;

    return $this;
  }

  public function getJwtKeys()
  {
    return $this->jwtKeys;
  }

  public function setJwtKeys($jwtKeys)
  {
    $this->jwtKeys = $jwtKeys;

    return $this;
  }

  public function getIdTokenSigningAlgorithm()
  {
    return $this->idTokenSigningAlgorithm;
  }

  public function setIdTokenSigningAlgorithm($idTokenSigningAlgorithm)
  {
    $this->idTokenSigningAlgorithm = $idTokenSigningAlgorithm;

    return $this;
  }

  public function getPolicy()
  {
    return $this->policy;
  }

  public function setPolicy($policy)
  {
    $this->policy = $policy;

    return $this;
  }

}
