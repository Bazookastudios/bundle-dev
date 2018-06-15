<?php
namespace DemoBundle\Services;

use Bazookas\ExportBundle\Services\Import\Base\BaseImportService;
use DemoBundle\Entity\Example;

class ExampleImportService extends BaseImportService
{
  /**
   * @param array $rowData
   * @throws \Doctrine\ORM\ORMException
   */
  protected function parseRow(array &$rowData): void
  {
    $entity = new Example();

    $entity
      ->setPublished($rowData['Published'] === '1')
      ->setTitle($rowData['Title'])
    ;

    $this->entityManager->persist($entity);
  }

  /**
   * Either return a numerically indexed array containing the expected column headers, or an associative array
   * mapping the headers in the file to the header that should be used when creating the $rowData arrays
   * @return array
   */
  protected function getExpectedColumnHeaders(): array
  {
    return [
      'Published',
      'Title'
    ];
  }

  /**
   * This function is called when the entire document has been parsed.
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  protected function onComplete(): void
  {
    $this->entityManager->flush();
  }
}
