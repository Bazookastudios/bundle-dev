<?php

namespace DemoBundle\Repository;

use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class LinkedListRepository extends BaseRepository
{
  /**
   * @param QueryBuilder $qb
   * @param array $params
   * @return QueryBuilder
   */
  public function beforeListQueryExecution(QueryBuilder $qb, array $params): QueryBuilder {
    $qb = parent::beforeListQueryExecution($qb, $params);

    $qb
      ->addSelect('partial details.{id, title, description, image, video}')
      ->leftJoin('e.details', 'details')

      ->addSelect('image')
      ->leftJoin('details.image', 'image')

      ->addSelect('video')
      ->leftJoin('details.video', 'video')
    ;

    return $qb;
  }
}
