<?php

namespace App\Repository\Auth;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Nitro\TokenAuthenticationBundle\Repository\Interfaces\AccessTokenRepositoryInterface;
use Nitro\TokenAuthenticationBundle\Repository\Traits\AccessTokenRepositoryTrait;

/**
 * Class AccessTokenRepository
 * @package App\Repository\Auth
 */
class AccessTokenRepository extends BaseRepository implements AccessTokenRepositoryInterface
{
    use AccessTokenRepositoryTrait;
}
