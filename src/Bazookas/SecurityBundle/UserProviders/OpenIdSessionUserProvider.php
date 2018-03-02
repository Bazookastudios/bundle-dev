<?php

namespace Bazookas\SecurityBundle\UserProviders;

use Bazookas\SecurityBundle\Entity\OpenIdUser;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SessionUserProvider
 * @package Bazookas\SecurityBundle\UserProviders
 *
 * A user provider which should only be used when users should not be retrieved from the database but should only exist in the session.
 */
class OpenIdSessionUserProvider implements UserProviderInterface
{
  protected $options;
  protected $session;

  public function __construct(Session $session, $options) {
    $resolver = new OptionsResolver();
    $resolver->setRequired(array(
      'entity'
    ));

    $this->options = $resolver->resolve($options);
    $this->session = $session;
  }

  public function loadUserByUsername($fieldValue)
  {
    if (empty($fieldValue)) {
      throw new UsernameNotFoundException();
    }

    //If a user exists in the session, retrieve this user.
    if (!empty($this->session->get('user'))) {
      $user = $this->session->get('user');

      if ($user instanceof OpenIdUser && $user->getOid() === $fieldValue) {
        return $user;
      } else {
        $this->session->remove('user');
      }
    }

    //create a new user
    $user = new $this->options['entity']($fieldValue);

    if ($user instanceof OpenIdUser) {
      $user->setOid($fieldValue);
    } else {
      throw new UnsupportedUserException(
        sprintf('Instances of "%s" are not supported.', get_class($user))
      );
    }

    $this->session->set('user', $user);
    $this->session->save();

    return $user;
  }

  public function refreshUser(UserInterface $user)
  {
    if (!$user instanceof $this->options['entity']) {
      throw new UnsupportedUserException(
        sprintf('Instances of "%s" are not supported.', get_class($user))
      );
    }

    return $this->loadUserByUsername($user->getOid());
  }

  public function supportsClass($class)
  {
    return $class === $this->options['entity'];
  }

}
