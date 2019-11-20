<?php

namespace App\Repository\App;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Nitro\AppCopyBundle\Repository\Interfaces\AppCopyRepositoryInterface;

/**
 * Class AppCopyRepository
 * @package App\Repository\App
 */
class AppCopyRepository extends BaseRepository implements AppCopyRepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return array
     */
    public function getAllCopy(string $locale): array
    {
        $qb = $this->createQueryBuilder('app_copy');
        $qb
            ->select('partial app_copy.{id}')
            ->addSelect('partial detail.{id, value}')
            ->join('app_copy.details', 'detail', 'WITH', $qb->expr()->eq('detail.locale', ':locale'))
            ->setParameter('locale', $locale)
        ;

        return $qb->getQuery()->getArrayResult();
    }
}
