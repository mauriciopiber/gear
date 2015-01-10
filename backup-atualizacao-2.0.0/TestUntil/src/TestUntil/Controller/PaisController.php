<?php
namespace TestUntil\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use TestUntil\Factory\PaisFactory;
use TestUntil\Service\PaisService;

class PaisController extends AbstractActionController
{
    const CREATE = 'test-until/pais/create';
    const EDIT   = 'test-until/pais/edit';
    const LISTS  = 'test-until/pais/list';
    const IMAGE  = 'test-until/pais/image';

    /** @var $paisFactory TestUntil\Factory\Pais */
    protected $paisFactory;

    /** @var $paisService TestUntil\Service\Pais */
    protected $paisService;



    public function createAction()
    {

        $form    = $this->getPaisFactory();
        $service = $this->getPaisService();

        $redirectUrl = $this->url()->fromRoute(self::CREATE);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        }

        if ($prg !== false) {
            $post = $prg;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $create = $service->create($data);
                if ($create) {
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $create->getIdPais(), 'success' => 1)
                    );
                }
            }
        }

        return (isset($view)) ? $view : new ViewModel(
            array(
                'form' => $form,
            )
        );
    }

    public function editAction()
    {
        $idPais = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idPais) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getPaisService()->selectById($idPais);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $form = $this->getPaisFactory();
        $service = $this->getPaisService();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $idPais));

        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;

            $form->setData($post);

            if ($form->isValid()) {

                $data = $form->getData();
                $update = $service->update($idPais, $data);

                if ($update) {
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdPais(), 'success' => 1)
                    );
                }
            }
        } else {
            $form->bind($data);
        }

        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return (isset($view)) ? $view : new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'idPais' => $idPais
            )
        );


    }

    public function listAction()
    {
        $formSearch = $this->getServiceLocator()->get(
            'TestUntil\Form\Search\PaisSearchForm'
        );

        $redirectUrl = $this->url()->fromRoute(self::LISTS);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $formSearch->setData($prg);
        } else {
            $prg = array();
        }

        $paisService = $this->getPaisService();

        return new ViewModel(
            array(
                'sucesso'   => $this->viewMessages()->listSuccess(),
                'search'    => $formSearch,
                'tableService' => $paisService,
                'orderBy'   => $paisService->getOrderBy(),
                'order'     => $paisService->getOrder(),
                'data'      => $paisService->getData($prg),
            )
        );
    }

    public function deleteAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $pais = $this->getPaisService();

        $delete = $pais->delete($identifier);

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

    public function setPaisFactory(PaisFactory $paisFactory)
    {
        $this->paisFactory = $paisFactory;
        return $this;
    }

    public function getPaisFactory()
    {
        if (!isset($this->paisFactory)) {
            $this->paisFactory =
                $this->getServiceLocator()->get('TestUntil\Factory\PaisFactory');
        }
        return $this->paisFactory;
    }

    public function setPaisService(PaisService $paisService)
    {
        $this->paisService = $paisService;
        return $this;
    }

    public function getPaisService()
    {
        if (!isset($this->paisService)) {
            $this->paisService =
                $this->getServiceLocator()->get('TestUntil\Service\PaisService');
        }
        return $this->paisService;
    }
}
