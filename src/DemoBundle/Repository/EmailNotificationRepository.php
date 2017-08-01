<?php
namespace DemoBundle\Repository;
use Bazookas\AdminBundle\Repository\Interfaces\Notification\EmailNotificationRepositoryInterface;
use Bazookas\AdminBundle\Repository\Traits\Notification\EmailNotificationRepositoryTrait;
use DemoBundle\Repository\Base\BaseNotificationRepository;

class EmailNotificationRepository extends BaseNotificationRepository implements EmailNotificationRepositoryInterface
{

  use EmailNotificationRepositoryTrait;

}
