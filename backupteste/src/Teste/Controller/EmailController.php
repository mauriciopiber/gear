<?php
namespace Teste\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use Teste\Factory\EmailFactoryTrait;
use Teste\Service\EmailServiceTrait;
use Teste\Factory\EmailSearchFactoryTrait;

class EmailController extends AbstractActionController
{
    const CREATE = 'teste/email/create';
    const EDIT   = 'teste/email/edit';
    const LISTS  = 'teste/email/list';
    const IMAGE  = 'teste/email/upload-image';

    use EmailFactoryTrait;
    use EmailServiceTrait;
    use EmailSearchFactoryTrait;


    public function createAction()
    {

        $form    = $this->getEmailFactory();
        $service = $this->getEmailService();

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
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $create->getIdEmail(), 'success' => 1)
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
        $idEmail = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idEmail) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getEmailService()->selectById($idEmail);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $form    = $this->getEmailFactory();
        $service = $this->getEmailService();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $idEmail));

        $prg = $this->prg($redirectUrl, true);


        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $update = $service->update($idEmail, $data);

                if ($update) {
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdEmail(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getEmailService()->selectById($idEmail);
            $form->bind($data);
        }


        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return (isset($view)) ? $view : new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'idEmail' => $idEmail
            )
        );
    }

    public function viewAction()
    {
        $idEmail = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idEmail) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getEmailService()->selectViewById($idEmail);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        return new ViewModel(
            array_merge(
                array(
                    'id' => $data->getIdEmail()
                ),
                $this->getEmailService()->extract($data)
            )
        );
    }

    public function deleteAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $email = $this->getEmailService();

        $delete = $email->delete($identifier);

        if ($delete) {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 1));
        } else {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 0));
        }
    }

    public function listAction()
    {
        $formSearch = $this->getEmailSearchFactory();

        $redirectUrl = $this->url()->fromRoute(self::LISTS);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $formSearch->setData($prg);
        } else {
            $prg = array();
        }

        $emailService = $this->getEmailService();

        return new ViewModel(
            array(
                'sucesso'   => $this->viewMessages()->listSuccess(),
                'search'    => $formSearch,
                'tableService' => $emailService,
                'orderBy'   => $emailService->getOrderBy(),
                'order'     => $emailService->getOrder(),
                'data'      => $emailService->getData($prg),
            )
        );
    }
}
