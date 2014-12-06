<?php
namespace PiberNetwork\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use PiberNetwork\Factory\TipoServicoFactory;
use PiberNetwork\Service\TipoServicoService;

class TipoServicoController extends AbstractActionController
{
    const CREATE = 'piber-network/tipo-servico/create';
    const EDIT   = 'piber-network/tipo-servico/edit';
    const LISTS  = 'piber-network/tipo-servico/list';
    const IMAGE  = 'piber-network/tipo-servico/image';

    /** @var $tipoServicoFactory PiberNetwork\Factory\TipoServico */
    protected $tipoServicoFactory;

    /** @var $tipoServicoService PiberNetwork\Service\TipoServico */
    protected $tipoServicoService;


    
    public function createAction()
    {


        $form = $this->getTipoServicoFactory();
        $redirectUrl = $this->url()->fromRoute(self::CREATE);

        $prg = $this->prg($redirectUrl, true);
        $service = $this->getTipoServicoService();

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
                        array('id' => $create->getIdTipoServico(), 'success' => 1)
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
        $form = $this->getTipoServicoFactory();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $identifier));

                $prg = $this->prg($redirectUrl, true);
        
        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;

            $form->setData($post);

            if ($form->isValid()) {

                $data = $form->getData();
                $service = $this->getTipoServicoService();

                $update = $service->update($identifier, $data);


                if ($update) {
                    return $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdTipoServico(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getTipoServicoService()->selectById($identifier);
            $form->bind($data);
        }



        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'idTipoServico' => $identifier
            )
        );
    }

    public function listAction()
    {
        $tipoServico = $this->getTipoServicoService();

        $data = $tipoServico->selectAll();

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

        $tipoServico = $this->getTipoServicoService();

        $delete = $tipoServico->delete($identifier);

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

    public function setTipoServicoFactory(TipoServicoFactory $tipoServicoFactory)
    {
        $this->tipoServicoFactory = $tipoServicoFactory;
        return $this;
    }

    public function getTipoServicoFactory()
    {
        if (!isset($this->tipoServicoFactory)) {
            $this->tipoServicoFactory =
                $this->getServiceLocator()->get('PiberNetwork\Factory\TipoServicoFactory');
        }
        return $this->tipoServicoFactory;
    }

    public function setTipoServicoService(TipoServicoService $tipoServicoService)
    {
        $this->tipoServicoService = $tipoServicoService;
        return $this;
    }

    public function getTipoServicoService()
    {
        if (!isset($this->tipoServicoService)) {
            $this->tipoServicoService =
                $this->getServiceLocator()->get('PiberNetwork\Service\TipoServicoService');
        }
        return $this->tipoServicoService;
    }
}
