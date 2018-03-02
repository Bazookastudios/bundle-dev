<?php

namespace Bazookas\SecurityBundle\UserProviders;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseUserProvider implements UserProviderInterface
{
  protected $entityManager;
  protected $options;

  public function __construct(EntityManager $entityManager, $options) {
    $this->entityManager = $entityManager;

    $resolver = new OptionsResolver();
    $resolver->setRequired(array(
      'entity'
    ));

    $this->options = $resolver->resolve($options);
  }

  public function loadUserByUsername($fieldValue)
  {
    //Retrieve the user
    $user = $this->getUserBy(array('username' => $fieldValue));

    if ($user instanceof $this->options['entity']) {
      return $user;
    }

    throw new UsernameNotFoundException(
        sprintf('Username "%s" does not exist.', $fieldValue)
    );
  }

  public function refreshUser(UserInterface $user)
  {
    if (!$user instanceof $this->options['entity']) {
      throw new UnsupportedUserException(
        sprintf('Instances of "%s" are not supported.', get_class($user))
      );
    }

    return $this->loadUserByUsername($user->getUsername());
  }

  public function supportsClass($class)
  {
    return $class === $this->options['entity'];
  }

  public function getUserBy(array $conditions) {
    $result = $this->entityManager
      ->getRepository($this->options['entity'])
      ->findOneBy($conditions)
    ;
    return $result;
  }

  public function createUser($id, $username) {
    $instance = new $this->options['entity']($username);
    $instance->setId($id);
    return $instance;
  }
}
