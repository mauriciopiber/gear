<?php
namespace PiberNetwork\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use PiberNetwork\Factory\CustoFactory;
use PiberNetwork\Service\CustoService;

class CustoController extends AbstractActionController
{
    const CREATE = 'piber-network/custo/create';
    const EDIT   = 'piber-network/custo/edit';
    const LISTS  = 'piber-network/custo/list';
    const IMAGE  = 'piber-network/custo/image';

    /** @var $custoFactory PiberNetwork\Factory\Custo */
    protected $custoFactory;

    /** @var $custoService PiberNetwork\Service\Custo */
    protected $custoService;



    public function createAction()
    {
        $form    = $this->getCustoFactory();
        $service = $this->getCustoService();

        $redirectUrl = $this->url()->fromRoute(self::CREATE);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;
            $form->setData($post);
            if ($form->isValid()) {

                $data = $form->getData();
                $create = $service->create($data);
                if ($create) {
                    return $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $create->getIdCusto(), 'success' => 1)
                    );
                }
            }
        }

        return new ViewModel(
            array(
                            'form' => $form,
            )
        );
    }

    public function editAction()
    {

        $idCusto = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idCusto) {
            return $this->redirect()->toRoute(self::LISTS);
        }
        $form = $this->getCustoFactory();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $idCusto));

        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;

            $form->setData($post);

            if ($form->isValid()) {

                $data = $form->getData();
                $service = $this->getCustoService();

                $update = $service->update($idCusto, $data);


                if ($update) {
                    return $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdCusto(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getCustoService()->selectById($idCusto);
            $form->bind($data);
        }

        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'idCusto' => $idCusto
            )
        );
    }

    public function listAction()
    {
        $formSearch = $this->getServiceLocator()->get('PiberNetwork\Factory\CustoSearchFactory');

        $redirectUrl = $this->url()->fromRoute(self::LISTS);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $formSearch->setData($prg);
        } else {
            $prg = array();
        }

        $custo = $this->getCustoService();

        return new ViewModel(
            array(
                'sucesso'   => $this->viewMessages()->listSuccess(),
                'search'    => $formSearch,
                'tableService' => $custo,
                'orderBy'   => $custo->getOrderBy(),
                'order'     => $custo->getOrder(),
                'data'      => $custo->getData($prg),
            )
        );

    }

    public function deleteAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $custo = $this->getCustoService();

        $delete = $custo->delete($identifier);

        if ($delete) {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 1));
        } else {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 0));
        }


    }

    public function viewAction()
    {
        return $this->redirect()->toRoute(self::LISTS);

        return new ViewModel(
            array()
        );
    }

    public function setCustoFactory(CustoFactory $custoFactory)
    {
        $this->custoFactory = $custoFactory;
        return $this;
    }

    public function getCustoFactory()
    {
        if (!isset($this->custoFactory)) {
            $this->custoFactory =
                $this->getServiceLocator()->get('PiberNetwork\Factory\CustoFactory');
        }
        return $this->custoFactory;
    }

    public function setCustoService(CustoService $custoService)
    {
        $this->custoService = $custoService;
        return $this;
    }

    public function getCustoService()
    {
        if (!isset($this->custoService)) {
            $this->custoService =
                $this->getServiceLocator()->get('PiberNetwork\Service\CustoService');
        }
        return $this->custoService;
    }
}
