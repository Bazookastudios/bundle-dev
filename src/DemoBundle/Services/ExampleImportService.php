<?php
namespace DemoBundle\Services;

use Bazookas\ExportBundle\Services\Import\Base\BaseImportService;
use DemoBundle\Entity\Example;

class ExampleImportService extends BaseImportService
{
  /**
   * @param array $rowData
   * @return array
   */
  protected function parseRow(array &$rowData)
  {
    $entity = new Example();

    $entity
      ->setPublished($rowData['Published'] === '1' ? true : false)
      ->setTitle($rowData['Title'])
    ;

    $this->entityManager->persist($entity);

    return $rowData;
  }

  /**
   * Either return a numerically indexed array containing the expected column headers, or an associative array
   * mapping the headers in the file to the header that should be used when creating the $rowData arrays
   * @return array
   */
  protected function getExpectedColumnHeaders()
  {
    return [
      'Published',
      'Title'
    ];
  }

  /**
   * This function is called when the entire document has been parsed.
   */
  protected function onComplete()
  {
    $this->entityManager->flush();
  }
}
