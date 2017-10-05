<?php

namespace DemoBundle\Controller;

use Bazookas\AdminBundle\AdminElements\Elements\Actions\PageActions\ImportPageActionElement;
use Bazookas\AdminBundle\Controller\Base\BaseAdminListController;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListPageBuilderInterface;
use Bazookas\AdminBundle\PageBuilder\ListPageBuilder;
use DemoBundle\Security\Roles;
use Bazookas\ExportBundle\Entity\GenericFileEntity;
use Bazookas\ExportBundle\Exception\ImportException;
use Bazookas\ExportBundle\Form\ImportFileForm;
use DemoBundle\Entity\Example;
use DemoBundle\Form\ExampleAdminType;
use DemoBundle\PageBuilder\ExamplePageBuilder;
use Symfony\Component\HttpFoundation\Request;

class ExampleAdminController extends BaseAdminListController
{

  function __construct()
  {
    // make sure parent construct is called!
    parent::__construct();

    $this->builders[self::ACTION_BULK_EDIT] = null;
    $this->builders[self::ACTION_LIST] = ExamplePageBuilder::class;
  }

  protected function modifyListBuilder(Request $request, ListPageBuilderInterface $builder)
  {
    /** @var ListPageBuilder $builder */
    $builder = parent::modifyListBuilder($request, $builder);

    $builder
      ->addBooleanField('published')
      ->addField('title')

      ->addBooleanFilterField('published')
      ->addTextFilterField('title')
    ;


    //Add the import functionality
    $entity = new GenericFileEntity();
    $form = $this->createForm(ImportFileForm::class, $entity);

    $form->handleRequest($request);
    $builder->setForm($form);

    if ($form->isValid() && $form->isSubmitted()) {
      $service = $this->get('demo.example.import_service');
      $entity = $service->handleUpload($entity);
      try {
        $service->process($entity, true, true);

        $translator = $this->get('translator');

        $this->addFlash('success', $translator->trans('admin.entities.example.onImported', [
          '%filename%' => $entity->getOriginalFileName()
        ], 'admin'));
      } catch(ImportException $e) {
        $this->addFlash('error', $e->getMessage());
      }
    }

    //Add the import button
    $importPageAction = new ImportPageActionElement([], [
      'label' => 'admin.entities.example.import',
      'action' => self::ACTION_LIST,
      'route' => $request->get('_route'),
      'attr' => [
        'data-toggle' => 'collapse',
        'role' => 'button',
        'aria-expanded' => !$form->isValid() && $form->isSubmitted() ? 'true' : 'false',
        'aria-controls' => 'js-inline-add-form',
        'href' => '#js-inline-add-form'
      ]
    ]);

    $builder->prependAction($importPageAction);

    return $builder;
  }

  protected function hasAccess($action) {
    return parent::hasAccess($action) && $this->isGranted(Roles::ROLE_EXAMPLE_ADMIN);
  }

  /**
   * @return string the entity fully qualified class name
   */
  protected function getEntityClass()
  {
    return Example::class;
  }

  /**
   * @param $action
   * @return string the fully qualified class name of the form
   */
  protected function getFormClass($action)
  {
    return ExampleAdminType::class;
  }
}
