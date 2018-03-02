<?php

namespace Bazookas\SecurityBundle\UserProviders;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailUserProvider extends BaseUserProvider
{

  public function loadUserByUsername($fieldValue)
  {
    //Retrieve the user
    $user = $this->getUserBy(array('email' => $fieldValue));

    if ($user instanceof $this->options['entity']) {
      return $user;
    }

    throw new UsernameNotFoundException(
        sprintf('Email "%s" does not exist.', $fieldValue)
    );
  }

  public function refreshUser(UserInterface $user)
  {
    if (!$user instanceof $this->options['entity']) {
      throw new UnsupportedUserException(
        sprintf('Instances of "%s" are not supported.', get_class($user))
      );
    }

    return $this->loadUserByUsername($user->getEmail());
  }
  
}
