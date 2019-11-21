<?php

namespace App\Repository\App;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Nitro\AppCopyBundle\Repository\Interfaces\AppCopyRepositoryInterface;
use Nitro\AppCopyBundle\Repository\Traits\AppCopyRepositoryTrait;

/**
 * Class AppCopyRepository
 * @package App\Repository\App
 */
class AppCopyRepository extends BaseRepository implements AppCopyRepositoryInterface
{
    use AppCopyRepositoryTrait;
}
