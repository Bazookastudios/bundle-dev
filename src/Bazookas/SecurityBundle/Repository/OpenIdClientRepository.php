<?php

namespace Bazookas\SecurityBundle\Repository;

use Bazookas\CommonBundle\Repository\Base\BaseRepository;
use Bazookas\SecurityBundle\Entity\OpenIdClient;

class OpenIdClientRepository extends BaseRepository
{

  public function getEntityClass() {
    return OpenIdClient::class;
  }

  public function getOpendIdClient($policy) {
    $qb = $this->entityManager->createQueryBuilder();
    $qb
      ->select('oic')
      ->from(OpenIdClient::class, 'oic')
      ->andWhere($qb->expr()->eq('oic.policy', ':policy'))
      ->setParameter('policy', $policy)
    ;

    $result = $qb->getQuery()->getOneOrNullResult();
    return $result;
  }
}
