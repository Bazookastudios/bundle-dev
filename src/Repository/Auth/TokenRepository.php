<?php

namespace App\Repository\Auth;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Nitro\TokenAuthenticationBundle\Repository\Interfaces\AccessTokenRepositoryInterface;
use Nitro\TokenAuthenticationBundle\Repository\Traits\AccessTokenRepositoryTrait;

/**
 * Class TokenRepository
 * @package App\Repository\Auth
 */
class TokenRepository extends BaseRepository implements AccessTokenRepositoryInterface
{
    use AccessTokenRepositoryTrait;
}
