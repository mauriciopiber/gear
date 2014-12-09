<?php
namespace PiberNetwork\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use PiberNetwork\Factory\StatusCustoFactory;
use PiberNetwork\Service\StatusCustoService;

class StatusCustoController extends AbstractActionController
{
    const CREATE = 'piber-network/status-custo/create';
    const EDIT   = 'piber-network/status-custo/edit';
    const LISTS  = 'piber-network/status-custo/list';
    const IMAGE  = 'piber-network/status-custo/image';

    /** @var $statusCustoFactory PiberNetwork\Factory\StatusCusto */
    protected $statusCustoFactory;

    /** @var $statusCustoService PiberNetwork\Service\StatusCusto */
    protected $statusCustoService;


    
    public function createAction()
    {


        $form = $this->getStatusCustoFactory();
        $redirectUrl = $this->url()->fromRoute(self::CREATE);

        $prg = $this->prg($redirectUrl, true);
        $service = $this->getStatusCustoService();

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
                        array('id' => $create->getIdStatusCusto(), 'success' => 1)
                    );
                }
            } else {


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

        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }
        $form = $this->getStatusCustoFactory();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $identifier));

                $prg = $this->prg($redirectUrl, true);
        
        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;

            $form->setData($post);

            if ($form->isValid()) {

                $data = $form->getData();
                $service = $this->getStatusCustoService();

                $update = $service->update($identifier, $data);


                if ($update) {
                    return $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdStatusCusto(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getStatusCustoService()->selectById($identifier);
            $form->bind($data);
        }



        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'idStatusCusto' => $identifier
            )
        );
    }

    public function listAction()
    {
        $statusCusto = $this->getStatusCustoService();

        $data = $statusCusto->selectAll();

        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);
        $success =  ($sucesso !== null) ? (int)$sucesso : null;


        return new ViewModel(
            array(
                'success' => $success,
                'data' => $data
            )
        );
    }

    public function deleteAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $statusCusto = $this->getStatusCustoService();

        $delete = $statusCusto->delete($identifier);

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

    public function setStatusCustoFactory(StatusCustoFactory $statusCustoFactory)
    {
        $this->statusCustoFactory = $statusCustoFactory;
        return $this;
    }

    public function getStatusCustoFactory()
    {
        if (!isset($this->statusCustoFactory)) {
            $this->statusCustoFactory =
                $this->getServiceLocator()->get('PiberNetwork\Factory\StatusCustoFactory');
        }
        return $this->statusCustoFactory;
    }

    public function setStatusCustoService(StatusCustoService $statusCustoService)
    {
        $this->statusCustoService = $statusCustoService;
        return $this;
    }

    public function getStatusCustoService()
    {
        if (!isset($this->statusCustoService)) {
            $this->statusCustoService =
                $this->getServiceLocator()->get('PiberNetwork\Service\StatusCustoService');
        }
        return $this->statusCustoService;
    }
}
