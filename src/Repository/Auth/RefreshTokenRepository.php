<?php

namespace App\Repository\Auth;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Nitro\TokenAuthenticationBundle\Repository\Interfaces\RefreshTokenRepositoryInterface;
use Nitro\TokenAuthenticationBundle\Repository\Traits\RefreshTokenRepositoryTrait;

/**
 * Class RefreshTokenRepository
 * @package App\Repository\Auth
 */
class RefreshTokenRepository extends BaseRepository implements RefreshTokenRepositoryInterface
{
    use RefreshTokenRepositoryTrait;
}
