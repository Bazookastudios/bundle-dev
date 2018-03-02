<?php
namespace DemoBundle\Controller\api;

use Bazookas\APIFrameworkBundle\Controller\Base\BaseController;
use Bazookas\APIFrameworkBundle\Services\Data\Interfaces\DataServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class ExampleController extends BaseController
{

  /**
   * Post an example instance
   * ### Post body ###
   *     {
   *       "title": "Title",
   *       "singleImage": {
   *         "title": "API test",
   *         "description": "A file uploaded by the API",
   *         "uploadIndex": 2
   *       },
   *       "multipleImages": [
   *         {
   *           "title": "First API image",
   *           "description": "First of multiple images",
   *           "uploadIndex": 0
   *         },
   *         {
   *           "title": "Second API image",
   *           "description": "Second of multiple images",
   *           "uploadIndex": 1
   *         }
   *       ]
   *     }
   *
   * ### Response body (success) ###
   *     {
   *       "status": "success",
   *       "uploadTargets": {
   *         "0": "http://localhost:8000/api/files/upload/791b276f1d0f99b58fb4a78caa4377ae/0",
   *         "1": "http://localhost:8000/api/files/upload/791b276f1d0f99b58fb4a78caa4377ae/1",
   *         "2": "http://localhost:8000/api/files/upload/791b276f1d0f99b58fb4a78caa4377ae/2"
   *       }
   *     }
   **/
  public function postAction(Request $request) {
    $retrieveParams = array(
      'title' => array(
        'required' => true,
      ),
      'singleImage' => array(
        'required' => true,
      ),
      'multipleImages' => array(
        'required' => false,
      )
    );

    return $this->handleRequest($request, $retrieveParams, 'postExample');
  }

  /**
   * Get the full list of example instances
   *
   * ### Response body ###
   *      {
   *       "status": "success",
   *       "data": [
   *         {...},
   *         {...}
   *       ],
   *       "pages": 1
   *     }
   **/
  public function getAction(Request $request) {
    // TODO pass locale to handleRequest
    $retrieveParams = array(
      'page' => array(
//        'constraint' => new Type('int'),
        'required' => false,
      ),
    );
    return $this->handleRequest($request, $retrieveParams, 'getExamples');
  }

  /**
   * Publish a single example
   **/
  public function publishAction(Request $request, $_id) {
    $retrieveParams = array();
    $extraParams = new ParameterBag();
    $extraParams->set('id', $_id);
    return $this->handleRequest($request, $retrieveParams, 'publishExample', Response::HTTP_OK, $extraParams);
  }
}
