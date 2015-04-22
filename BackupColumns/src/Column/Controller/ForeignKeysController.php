<?php
namespace Column\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use Column\Factory\ForeignKeysFactoryTrait;
use Column\Service\ForeignKeysServiceTrait;
use Column\Factory\ForeignKeysSearchFactoryTrait;

class ForeignKeysController extends AbstractActionController
{
    const CREATE = 'column/foreign-keys/create';
    const EDIT   = 'column/foreign-keys/edit';
    const LISTS  = 'column/foreign-keys/list';
    const IMAGE  = 'column/foreign-keys/upload-image';

    use ForeignKeysFactoryTrait;
    use ForeignKeysServiceTrait;
    use ForeignKeysSearchFactoryTrait;


    public function createAction()
    {

        $form    = $this->getForeignKeysFactory();
        $service = $this->getForeignKeysService();

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
                        array('id' => $create->getIdForeignKeys(), 'success' => 1)
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
        $idForeignKeys = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idForeignKeys) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getForeignKeysService()->selectById($idForeignKeys);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $form    = $this->getForeignKeysFactory();
        $service = $this->getForeignKeysService();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $idForeignKeys));

        $prg = $this->prg($redirectUrl, true);


        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $update = $service->update($idForeignKeys, $data);

                if ($update) {
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdForeignKeys(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getForeignKeysService()->selectById($idForeignKeys);
            $form->bind($data);
        }


        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return (isset($view)) ? $view : new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'idForeignKeys' => $idForeignKeys
            )
        );
    }

    public function viewAction()
    {
        $idForeignKeys = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idForeignKeys) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getForeignKeysService()->selectById($idForeignKeys);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        return new ViewModel(
            array_merge(
                array(
                    'id' => $data->getIdForeignKeys()
                ),
                $this->getForeignKeysService()->extract($data)
            )
        );
    }

    public function deleteAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $foreignKeys = $this->getForeignKeysService();

        $delete = $foreignKeys->delete($identifier);

        if ($delete) {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 1));
        } else {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 0));
        }
    }

    public function listAction()
    {
        $formSearch = $this->getforeignKeysSearchFactory();

        $redirectUrl = $this->url()->fromRoute(self::LISTS);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $formSearch->setData($prg);
        } else {
            $prg = array();
        }

        $foreignKeysService = $this->getForeignKeysService();

        return new ViewModel(
            array(
                'sucesso'   => $this->viewMessages()->listSuccess(),
                'search'    => $formSearch,
                'tableService' => $foreignKeysService,
                'orderBy'   => $foreignKeysService->getOrderBy(),
                'order'     => $foreignKeysService->getOrder(),
                'data'      => $foreignKeysService->getData($prg),
            )
        );
    }
}
