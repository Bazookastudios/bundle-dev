<?php

namespace App\Repository\Translation;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\QueryException;
use Nitro\TranslationBundle\Entity\Interfaces\TranslationInterface;
use Nitro\TranslationBundle\Repository\Interfaces\TranslationRepositoryInterface;
use function sprintf;
use function strtoupper;

/**
 * Class TranslationRepository
 * @package App\Repository\Translation
 */
class TranslationRepository extends BaseRepository implements TranslationRepositoryInterface
{
    /**
     * @param string $domain
     * @param string $locale
     *
     * @return array
     * @throws QueryException
     */
    public function getTranslations(string $domain, string $locale): array
    {
        if (empty($locale)) {
            return [];
        }

        $qb = $this->createQueryBuilder('translation');
        $qb
            ->select(sprintf('partial translation.{id, key, translation%s}', strtoupper($locale)))
            ->where($qb->expr()->eq('translation.domain', ':domain'))
            ->setParameter('domain', $domain)
            ->indexBy('translation', 'translation.key')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $domain
     * @param string $key
     *
     * @return TranslationInterface|null
     * @throws NonUniqueResultException
     */
    public function getTranslation(string $domain, string $key): ?TranslationInterface
    {
        $qb = $this->createQueryBuilder('translation');
        $qb
            ->where($qb->expr()->eq('translation.domain', ':domain'))
            ->andWhere($qb->expr()->eq('translation.key', ':key'))
            ->setParameters([
                'domain' => $domain,
                'key' => $key,
            ])
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function getAllTranslationsAsAMap(): array
    {
        $qb = $this->createQueryBuilder('translation');
        $qb->select('partial translation.{id, domain, key, translationNL, translationFR, translationEN }');
        $translations = $qb->getQuery()->getArrayResult();

        $formatted = [];
        foreach ($translations as $translation) {
            $domain = $translation['domain'];
            $key = $translation['key'];

            $formatted[$domain][$key] = [
                'nl' => $translation['translationNL'],
                'fr' => $translation['translationFR'],
                'en' => $translation['translationEN'],
            ];
        }

        return $formatted;
    }
}
