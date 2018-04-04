<?php

namespace DemoBundle\Controller;

use Bazookas\AdminBundle\Controller\Base\BaseAdminListController;
use Bazookas\AdminBundle\PageBuilder\Base\BaseFormPageBuilder;
use Bazookas\AdminBundle\PageBuilder\Interfaces\BulkPageBuilderInterface;
use Bazookas\AdminBundle\PageBuilder\Interfaces\FormPageBuilderInterface;
use Bazookas\AdminBundle\PageBuilder\Interfaces\ListPageBuilderInterface;
use Bazookas\AdminBundle\PageBuilder\ListPageBuilder;
use Bazookas\AdminBundle\Security\Roles;
use Bazookas\CommonBundle\Entity\Interfaces\AccessControlInterface;
use DemoBundle\Entity\Example;
use DemoBundle\Entity\Product;
use DemoBundle\Form\ExampleAdminType;
use DemoBundle\PageBuilder\ExamplePageBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ExampleAdminController extends BaseAdminListController
{

  public function __construct()
  {
    // make sure parent construct is called!
    parent::__construct();

//    $this->builders[AccessControlInterface::ACTION_BULK_EDIT] = null;
    $this->builders[AccessControlInterface::ACTION_LIST] = ExamplePageBuilder::class;
  }

  protected function modifyListBuilder(Request $request, ListPageBuilderInterface $builder): ListPageBuilderInterface
  {
    /** @var ListPageBuilder $builder */
    $builder = parent::modifyListBuilder($request, $builder);

    $builder
      ->addBooleanField('published')
      ->addSortableField('title')

      ->addBooleanFilterField('published')
      ->addTextFilterField('title')
    ;


    //Add the import functionality
//    $entity = new GenericFileEntity();
//    $form = $this->createForm(ImportFileForm::class, $entity);
//
//    $form->handleRequest($request);
//    $builder->setForm($form);
//
//    if ($form->isValid() && $form->isSubmitted()) {
//      $service = $this->get('demo.example.import_service');
//      $entity = $service->handleUpload($entity);
//      try {
//        $service->process($entity, true, true);
//
//        $translator = $this->get('translator');
//
//        $this->addFlash('success', $translator->trans('admin.entities.example.onImported', [
//          '%filename%' => $entity->getOriginalFileName()
//        ], 'admin'));
//      } catch(ImportException $e) {
//        $this->addFlash('error', $e->getMessage());
//      }
//    }
//
//    //Add the import button
//    $importPageAction = new ImportPageActionElement([], [
//      'label' => 'admin.entities.example.import',
//      'action' => self::ACTION_LIST,
//      'route' => $request->get('_route'),
//      'attr' => [
//        'data-toggle' => 'collapse',
//        'role' => 'button',
//        'aria-expanded' => !$form->isValid() && $form->isSubmitted() ? 'true' : 'false',
//        'aria-controls' => 'js-inline-add-form',
//        'href' => '#js-inline-add-form'
//      ]
//    ]);
//
//    $builder->prependAction($importPageAction);

    return $builder;
  }

  /**
   * @param string $action
   * @return bool
   * @throws \LogicException
   */
  protected function hasAccess(string $action): bool {
    switch($action) {
      case AccessControlInterface::ACTION_LIST:
      case AccessControlInterface::ACTION_EDIT:
      case AccessControlInterface::ACTION_ADD:
      case AccessControlInterface::ACTION_REMOVE:
      case AccessControlInterface::ACTION_CLONE:
      case AccessControlInterface::ACTION_BULK_EDIT:
        return Roles::ROLE_SUPER_ADMIN;
      default:
        return false;
    }
  }

  /**
   * @return string the entity fully qualified class name
   */
  protected function getEntityClass(): ?string
  {
    return Example::class;
  }

  /**
   * @param $action
   * @return string the fully qualified class name of the form
   */
  protected function getFormClass(string $action): ?string
  {
    return ExampleAdminType::class;
  }
}
