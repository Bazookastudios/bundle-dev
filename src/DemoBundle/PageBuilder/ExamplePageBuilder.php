<?php
namespace DemoBundle\PageBuilder;

use Bazookas\AdminBundle\AdminElements\Containers\CollapsibleContainer;
use Bazookas\AdminBundle\AdminElements\Elements\FormPanelElement;
use Bazookas\AdminBundle\PageBuilder\ListPageBuilder;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ExamplePageBuilder extends ListPageBuilder
{

  /**
   * @var Form
   */
  protected $form;

  /**
   * @return Form
   */
  public function getForm()
  {
    return $this->form;
  }

  /**
   * @param Form $form
   * @return $this
   */
  public function setForm(Form $form)
  {
    $this->form = $form;

    return $this;
  }

  /**
   * @inheritDoc
   */
  public function buildPage(Request $request): void {
    //Add a header element
    $this->elements[] = $this->generateHeaderElement();

//    $this->elements[] = $this->buildImportForm();

    //Add the list table
    $this->elements[] = $this->buildListTable($request);
  }

  /**
   * @return CollapsibleContainer
   */
  private function buildImportForm()
  {
    $formElement = new FormPanelElement([], [
      'form' => $this->getForm()->createView(),
      'label' => 'admin.entities.example.addLabel',
    ]);

    $form = $this->getForm();

    return new CollapsibleContainer([$formElement], [
      'id' => 'js-inline-add-form',
      'initiallyCollapsed' => !(!$form->isValid() && $form->isSubmitted()),
    ]);
  }

}
