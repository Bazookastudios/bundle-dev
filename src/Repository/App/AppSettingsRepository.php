<?php

namespace App\Repository\App;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Nitro\AppSettingsBundle\Repository\Interfaces\AppSettingsRepositoryInterface;
use Nitro\AppSettingsBundle\Repository\Traits\AppSettingsRepositoryTrait;

/**
 * Class AppSettingsRepository
 * @package App\Repository\App
 */
class AppSettingsRepository extends BaseRepository implements AppSettingsRepositoryInterface
{
    use AppSettingsRepositoryTrait;
}
