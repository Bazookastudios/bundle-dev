<?php

namespace DemoBundle\Repository;

use Bazookas\AdminBundle\Repository\Interfaces\LinkedListRepositoryInterface;
use Bazookas\AdminBundle\Repository\Traits\LinkedListRepositoryTrait;
use Bazookas\AdminBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class LinkedListRepository extends BaseRepository implements LinkedListRepositoryInterface
{
  use LinkedListRepositoryTrait;

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

      ->addSelect('partial image.{id, url}')
      ->leftJoin('details.image', 'image')

      ->addSelect('partial video.{id, url}')
      ->leftJoin('details.video', 'video')
    ;

    return $qb;
  }

}
