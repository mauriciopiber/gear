<?php
namespace PiberNetwork\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use PiberNetwork\Factory\PrecoTipoServicoFactory;
use PiberNetwork\Service\PrecoTipoServicoService;

class PrecoTipoServicoController extends AbstractActionController
{
    const CREATE = 'piber-network/preco-tipo-servico/create';
    const EDIT   = 'piber-network/preco-tipo-servico/edit';
    const LISTS  = 'piber-network/preco-tipo-servico/list';
    const IMAGE  = 'piber-network/preco-tipo-servico/image';

    /** @var $factory PiberNetwork\Factory\PrecoTipoServico */
    protected $factory;

    /** @var $service PiberNetwork\Service\PrecoTipoServico */
    protected $service;


    
    public function createAction()
    {


        $form = $this->getPrecoTipoServicoFactory();
        $redirectUrl = $this->url()->fromRoute(self::CREATE);

        $prg = $this->prg($redirectUrl, true);
        $service = $this->getPrecoTipoServicoService();

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
                        array('id' => $create->getIdPrecoTipoServico(), 'success' => 1)
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
        $form = $this->getPrecoTipoServicoFactory();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $identifier));

                $prg = $this->prg($redirectUrl, true);
        
        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;

            $form->setData($post);

            if ($form->isValid()) {

                $data = $form->getData();
                $service = $this->getPrecoTipoServicoService();

                $update = $service->update($identifier, $data);


                if ($update) {
                    return $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdPrecoTipoServico(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getPrecoTipoServicoService()->selectById($identifier);
            $form->bind($data);
        }



        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'idPrecoTipoServico' => $identifier
            )
        );
    }

    public function listAction()
    {
        $precoTipoServico = $this->getPrecoTipoServicoService();

        $data = $precoTipoServico->selectAll();

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

        $precoTipoServico = $this->getPrecoTipoServicoService();

        $delete = $precoTipoServico->delete($identifier);

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

    public function setPrecoTipoServicoFactory(PrecoTipoServicoFactory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    public function getPrecoTipoServicoFactory()
    {
        if (!isset($this->factory)) {
            $this->factory =
                $this->getServiceLocator()->get('PiberNetwork\Factory\PrecoTipoServicoFactory');
        }
        return $this->factory;
    }

    public function setPrecoTipoServicoService(PrecoTipoServicoService $service)
    {
        $this->service = $service;
        return $this;
    }

    public function getPrecoTipoServicoService()
    {
        if (!isset($this->service)) {
            $this->service =
                $this->getServiceLocator()->get('PiberNetwork\Service\PrecoTipoServicoService');
        }
        return $this->service;
    }
}
