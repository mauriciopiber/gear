<?php
namespace PiberNetwork\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use PiberNetwork\Factory\GrupoCustoFactory;
use PiberNetwork\Service\GrupoCustoService;

class GrupoCustoController extends AbstractActionController
{
    const CREATE = 'piber-network/grupo-custo/create';
    const EDIT   = 'piber-network/grupo-custo/edit';
    const LISTS  = 'piber-network/grupo-custo/list';
    const IMAGE  = 'piber-network/grupo-custo/image';

    /** @var $grupoCustoFactory PiberNetwork\Factory\GrupoCusto */
    protected $grupoCustoFactory;

    /** @var $grupoCustoService PiberNetwork\Service\GrupoCusto */
    protected $grupoCustoService;


    
    public function createAction()
    {


        $form = $this->getGrupoCustoFactory();
        $redirectUrl = $this->url()->fromRoute(self::CREATE);

        $prg = $this->prg($redirectUrl, true);
        $service = $this->getGrupoCustoService();

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
                        array('id' => $create->getIdGrupoCusto(), 'success' => 1)
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
        $form = $this->getGrupoCustoFactory();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $identifier));

                $prg = $this->prg($redirectUrl, true);
        
        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;

            $form->setData($post);

            if ($form->isValid()) {

                $data = $form->getData();
                $service = $this->getGrupoCustoService();

                $update = $service->update($identifier, $data);


                if ($update) {
                    return $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdGrupoCusto(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getGrupoCustoService()->selectById($identifier);
            $form->bind($data);
        }



        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'idGrupoCusto' => $identifier
            )
        );
    }

    public function listAction()
    {
        $grupoCusto = $this->getGrupoCustoService();

        $data = $grupoCusto->selectAll();

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

        $grupoCusto = $this->getGrupoCustoService();

        $delete = $grupoCusto->delete($identifier);

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

    public function setGrupoCustoFactory(GrupoCustoFactory $grupoCustoFactory)
    {
        $this->grupoCustoFactory = $grupoCustoFactory;
        return $this;
    }

    public function getGrupoCustoFactory()
    {
        if (!isset($this->grupoCustoFactory)) {
            $this->grupoCustoFactory =
                $this->getServiceLocator()->get('PiberNetwork\Factory\GrupoCustoFactory');
        }
        return $this->grupoCustoFactory;
    }

    public function setGrupoCustoService(GrupoCustoService $grupoCustoService)
    {
        $this->grupoCustoService = $grupoCustoService;
        return $this;
    }

    public function getGrupoCustoService()
    {
        if (!isset($this->grupoCustoService)) {
            $this->grupoCustoService =
                $this->getServiceLocator()->get('PiberNetwork\Service\GrupoCustoService');
        }
        return $this->grupoCustoService;
    }
}
