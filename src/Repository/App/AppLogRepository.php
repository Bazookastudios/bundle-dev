<?php

namespace App\Repository\App;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Bazookas\APIFrameworkBundle\Repository\Interfaces\AppLogRepositoryInterface;
use Bazookas\APIFrameworkBundle\Repository\Traits\AppLogRepositoryTrait;

/**
 * Class AppLogRepository
 * @package ApiBundle\Repository\App
 */
class AppLogRepository extends BaseRepository implements AppLogRepositoryInterface
{
    use AppLogRepositoryTrait;
}
