<?php
namespace DemoBundle\EventListener;
use Bazookas\AdminBundle\Services\Notification\NotificationService;
use Bazookas\CommonBundle\Security\Roles;
use DemoBundle\Controller\ExampleAdminController;
use DemoBundle\Entity\CMSNotification;
use DemoBundle\Entity\EmailNotification;
use DemoBundle\Entity\Example;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Router;

class ExampleNotificationSubscriber implements ContainerAwareInterface, EventSubscriber
{
  /**
   * @var ContainerInterface
   */
  private $container;

  /**
   * @var Router
   */
  private $router;

  public function __construct(ContainerInterface $container, Router $router) {
    $this->setContainer($container);
    $this->router = $router;
  }

  public function getSubscribedEvents()
  {
    return [
      'postPersist',
      'postUpdate',
    ];
  }

  /**
   * Sets the container.
   *
   * @param ContainerInterface|null $container A ContainerInterface instance or null
   */
  public function setContainer(ContainerInterface $container = null)
  {
    $this->container = $container;
  }

  /**
   * @param LifecycleEventArgs $args
   */
  public function postPersist(LifecycleEventArgs $args) {
    $this->addNotification($args);
    $this->sendEmailNotification($args);
  }

  /**
   * @param LifecycleEventArgs $args
   */
  public function postUpdate(LifecycleEventArgs $args) {
    $this->addNotification($args, false);
  }

  /**
   * @param LifecycleEventArgs $args
   */
  private function addNotification(LifecycleEventArgs $args, $isNew = true)
  {
    $object = $args->getObject();
    if (!$object instanceof Example) {
      // only handle example entities
      return;
    }

    // NOTE: I get circular reference errors so
    // injected the container to load notification service manually
    $notificationService = $this->container->get('bazookas.admin.service.NotificationService');

    $link = $this->router->generate('demo_example_admin', [
      '_action' => ExampleAdminController::ACTION_VIEW,
      '_id' => $object->getId()
    ]);

    $notification = new CMSNotification();
    $notification
      ->setMessage('admin.notifications.' . ($isNew ? 'newDemoItem' : 'updatedDemoItem'))
      ->setIcon('fa fa-2x ' . ($isNew ? 'fa-plus' : 'fa-pencil'))
      ->setLink($link);

    $notificationService->addNotification($notification, [Roles::ROLE_SUPER_ADMIN]);
  }

  /**
   * @param LifecycleEventArgs $args
   */
  private function sendEmailNotification(LifecycleEventArgs $args)
  {
    $object = $args->getObject();
    if (!$object instanceof Example) {
      // only handle example entities
      return;
    }

    // NOTE: I get circular reference errors so
    // injected the container to load notification service manually
    $notificationService = $this->container->get('bazookas.admin.service.NotificationService');

    $link = $this->router->generate('demo_example_admin', [
      '_action' => ExampleAdminController::ACTION_VIEW,
      '_id' => $object->getId()
    ]);

    $notification = new EmailNotification();
    $notification
      ->setMessage('admin.notifications.newDemoItem')
      ->setLink($link);

    $notificationService->addNotification($notification, [Roles::ROLE_SUPER_ADMIN]);
  }
}
