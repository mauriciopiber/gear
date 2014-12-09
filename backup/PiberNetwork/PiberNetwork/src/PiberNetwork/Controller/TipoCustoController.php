<?php
namespace PiberNetwork\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use PiberNetwork\Factory\TipoCustoFactory;
use PiberNetwork\Service\TipoCustoService;

class TipoCustoController extends AbstractActionController
{
    const CREATE = 'piber-network/tipo-custo/create';
    const EDIT   = 'piber-network/tipo-custo/edit';
    const LISTS  = 'piber-network/tipo-custo/list';
    const IMAGE  = 'piber-network/tipo-custo/image';

    /** @var $tipoCustoFactory PiberNetwork\Factory\TipoCusto */
    protected $tipoCustoFactory;

    /** @var $tipoCustoService PiberNetwork\Service\TipoCusto */
    protected $tipoCustoService;

    public function createAction()
    {
        $service = $this->getTipoCustoService();
        $form = $this->getTipoCustoFactory();

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
                        array('id' => $create->getIdTipoCusto(), 'success' => 1)
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

        $idTipoCusto = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idTipoCusto) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $form    = $this->getTipoCustoFactory();
        $service = $this->getTipoCustoService();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $idTipoCusto));
        $prg = $this->prg($redirectUrl, true);
        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;
            $form->setData($post);

            if ($form->isValid()) {

                $data = $form->getData();
                $update = $service->update($idTipoCusto, $data);
                if ($update) {
                    return $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdTipoCusto(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getTipoCustoService()->selectById($idTipoCusto);
            $form->bind($data);
        }

        return new ViewModel(
            array(
                'form' => $form,
                'success' => $this->viewMessages()->editSuccess(),
                'idTipoCusto' => $idTipoCusto
            )
        );
    }

    public function listAction()
    {
        $formSearch = $this->getServiceLocator()->get('PiberNetwork\Factory\TipoCustoSearchFactory');

        $redirectUrl = $this->url()->fromRoute(self::LISTS);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $formSearch->setData($prg);
        } else {
            $prg = array();
        }
        $tipoCusto = $this->getTipoCustoService();

        return new ViewModel(
            array(
                'sucesso'   => $this->viewMessages()->listSuccess(),
                'search'    => $formSearch,
                'tableService' => $tipoCusto,
                'orderBy'   => $tipoCusto->getOrderBy(),
                'order'     => $tipoCusto->getOrder(),
                'data'      => $tipoCusto->getData($prg),
            )
        );
    }

    public function deleteAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $tipoCusto = $this->getTipoCustoService();

        $delete = $tipoCusto->delete($identifier);

        return ($delete) ?
          $this->redirect()->toRoute(self::LISTS, array('success' => 1)) :
          $this->redirect()->toRoute(self::LISTS, array('success' => 0));
    }

    public function viewAction()
    {
        return $this->redirect()->toRoute(self::LISTS);

        return new ViewModel(
            array()
        );
    }

    public function setTipoCustoFactory(TipoCustoFactory $tipoCustoFactory)
    {
        $this->tipoCustoFactory = $tipoCustoFactory;
        return $this;
    }

    public function getTipoCustoFactory()
    {
        if (!isset($this->tipoCustoFactory)) {
            $this->tipoCustoFactory =
                $this->getServiceLocator()->get('PiberNetwork\Factory\TipoCustoFactory');
        }
        return $this->tipoCustoFactory;
    }

    public function setTipoCustoService(TipoCustoService $tipoCustoService)
    {
        $this->tipoCustoService = $tipoCustoService;
        return $this;
    }

    public function getTipoCustoService()
    {
        if (!isset($this->tipoCustoService)) {
            $this->tipoCustoService =
                $this->getServiceLocator()->get('PiberNetwork\Service\TipoCustoService');
        }
        return $this->tipoCustoService;
    }
}
