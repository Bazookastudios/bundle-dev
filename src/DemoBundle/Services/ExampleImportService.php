<?php
namespace DemoBundle\Services;

use Bazookas\ExportBundle\Services\Import\Base\BaseImportService;

class ExampleImportService extends BaseImportService
{

  /**
   * @param array $rowData
   * @return array
   */
  protected function parseRow(array &$rowData)
  {
    // TODO: Implement parseRow() method.
  }

  /**
   * Either return a numerically indexed array containing the expected column headers, or an associative array
   * mapping the headers in the file to the header that should be used when creating the $rowdData arrays
   * @return array
   */
  protected function getExpectedColumnHeaders()
  {
    // TODO: Implement getExpectedColumnHeaders() method.
  }

  /**
   * This function is called when the entire document has been parsed.
   */
  protected function onComplete()
  {
    // TODO: Implement onComplete() method.
  }
}
