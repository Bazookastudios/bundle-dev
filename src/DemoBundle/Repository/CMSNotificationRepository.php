<?php
namespace DemoBundle\Repository;

use Bazookas\AdminBundle\Repository\Interfaces\Notification\CMSNotificationRepositoryInterface;
use Bazookas\AdminBundle\Repository\Traits\Notification\CMSNotificationRepositoryTrait;
use DemoBundle\Repository\Base\BaseNotificationRepository;

class CMSNotificationRepository extends BaseNotificationRepository implements CMSNotificationRepositoryInterface {

  use CMSNotificationRepositoryTrait;

}
