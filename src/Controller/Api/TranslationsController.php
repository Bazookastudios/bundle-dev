<?php

namespace App\Controller\Api;

use Nitro\TranslationBundle\Controller\Api\Interfaces\TranslationAwareInterface;
use Nitro\TranslationBundle\Controller\Api\Traits\TranslationAwareTrait;

/**
 * Class TranslationsController
 * @package Controller\Api
 */
class TranslationsController implements TranslationAwareInterface
{
    use TranslationAwareTrait;
}
