<?php

namespace App\Repository\Fact;

use App\Entity\Fact\Fact;
use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query;

/**
 * Class FactRepository
 * @package App\Repository\Fact
 */
class FactRepository extends BaseRepository
{
    /**
     * @param string $locale
     *
     * @return Fact[]
     */
    public function getFactsByLocale(string $locale): array
    {
        $qb = $this->createQueryBuilder('fact');

        $qb
            ->addSelect('details')
            ->join(
                'fact.details',
                'details',
                'WITH',
                $qb->expr()->eq('details.locale', ':locale')
            )
            ->setParameter('locale', $locale)
        ;

        return $qb->getQuery()->getResult(Query::HYDRATE_OBJECT);
    }
}
