<?php

namespace App\Controller\Admin\Fact;

use App\Entity\Fact\Fact;
use App\Form\Admin\Fact\FactAdminType;
use Bazookas\AdminBundle\Builder\Page\FormPageBuilder;
use Bazookas\AdminBundle\Builder\Page\Interfaces\ListTablePageBuilderInterface;
use Bazookas\AdminBundle\Builder\Page\ListTablePageBuilder;
use Bazookas\AdminBundle\Controller\Base\BaseAdminListTableController;
use Bazookas\AdminBundle\Entity\Interfaces\AccessControlInterface;
use Bazookas\AdminBundle\Security\Roles;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;

/**
 * Class FactAdminController
 * @package App\Controller\Admin\Fact
 */
class FactAdminController extends BaseAdminListTableController
{
    /**
     * FactAdminController constructor.
     *
     * @param FormPageBuilder      $formPageBuilder
     * @param ListTablePageBuilder $listTablePageBuilder
     */
    public function __construct(FormPageBuilder $formPageBuilder, ListTablePageBuilder $listTablePageBuilder)
    {
        $this->builders = [
            AccessControlInterface::ACTION_LIST => $listTablePageBuilder,
            AccessControlInterface::ACTION_ADD => $formPageBuilder,
            AccessControlInterface::ACTION_EDIT => $formPageBuilder,
            AccessControlInterface::ACTION_REMOVE => $listTablePageBuilder,
        ];
    }

    /**
     * @return string|null
     */
    protected function getEntityClass(): ?string
    {
        return Fact::class;
    }

    /**
     * @param Request                       $request
     * @param ListTablePageBuilderInterface $builder
     *
     * @return ListTablePageBuilderInterface
     *
     * @throws ReflectionException
     * @throws ExceptionInterface
     */
    protected function modifyListBuilder(
        Request $request,
        ListTablePageBuilderInterface $builder
    ): ListTablePageBuilderInterface {
        $builder = parent::modifyListBuilder($request, $builder);

        $builder
            ->addDetailsField('fact')
            ->addDetailsFilterField('fact')
        ;

        return $builder;
    }

    /**
     * @param string $action
     *
     * @return string|null
     */
    protected function getFormClass(string $action): ?string
    {
        switch ($action) {
            case AccessControlInterface::ACTION_EDIT:
            case AccessControlInterface::ACTION_ADD:
                return FactAdminType::class;
            default:
                return null;
        }
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    protected function hasAccess(string $action): bool
    {
        switch ($action) {
            case AccessControlInterface::ACTION_LIST:
            case AccessControlInterface::ACTION_EDIT:
            case AccessControlInterface::ACTION_ADD:
            case AccessControlInterface::ACTION_REMOVE:
                return $this->isGranted(Roles::ROLE_ADMIN);
            default:
                return false;
        }
    }
}
