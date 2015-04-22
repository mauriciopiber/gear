<?php
namespace Column\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use Column\Factory\ColumnsFactoryTrait;
use Column\Service\ColumnsServiceTrait;
use Column\Factory\ColumnsSearchFactoryTrait;

class ColumnsController extends AbstractActionController
{
    const CREATE = 'column/columns/create';
    const EDIT   = 'column/columns/edit';
    const LISTS  = 'column/columns/list';
    const IMAGE  = 'column/columns/upload-image';

    use ColumnsFactoryTrait;
    use ColumnsServiceTrait;
    use ColumnsSearchFactoryTrait;
    use \GearBase\Controller\PasswordVerifyTrait;
    use \GearBase\Controller\UploadImageTrait;


    public function createAction()
    {
        /** \Column\Varchar\UploadImage */
        $this->dropUploadImageSession();

        $this->form    = $this->getColumnsFactory();
        $service = $this->getColumnsService();

        $redirectUrl = $this->url()->fromRoute(self::CREATE);
        $prg = $this->filePostRedirectGet($this->form, $redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $this->post = $prg;
            /** \Column\Varchar\PasswordVerify */
            $this->checkPasswordVerify('columnVarcharPasswordVerify');

            $this->form->setData($this->post);
            if ($this->form->isValid()) {
                $data = $this->form->getData();
                $create = $service->create($data);
                if ($create) {
                    $this->dropUploadImageSession();
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $create->getIdColumns(), 'success' => 1)
                    );
                }
            } else {
                var_dump($this->form->getMessages());

                $this->verifyErrors('columnVarcharUploadImage');
            }
        }

        $columnVarcharUploadImage = $this->getTempUpload('columnVarcharUploadImage');


        return (isset($view)) ? $view : new ViewModel(
            array(
                'columnVarcharUploadImage' => $columnVarcharUploadImage,
                'form' => $this->form,
            )
        );
    }

    public function editAction()
    {
        $idColumns = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idColumns) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getColumnsService()->selectById($idColumns);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $this->form    = $this->getColumnsFactory();
        $service = $this->getColumnsService();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $idColumns));

        $prg = $this->filePostRedirectGet($this->form, $redirectUrl, true);


        $columnVarcharUploadImage = '';


        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;
                $this->checkPasswordVerify('columnVarcharPasswordVerify');
            $this->form->setData($post);
            if ($this->form->isValid()) {
                $data = $this->form->getData();

                $update = $service->update($idColumns, $data);

                if ($update) {
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdColumns(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getColumnsService()->selectById($idColumns);
            $data->setColumnVarcharPasswordVerify('');
            $this->form->bind($data);
        }


        if ($data instanceof \Column\Entity\Columns && $data->getColumnVarcharUploadImage() !== null) {
            $columnVarcharUploadImage = str_replace('/public', '', sprintf($data->getColumnVarcharUploadImage(), 'pre'));
        }


        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return (isset($view)) ? $view : new ViewModel(
            array(
                'form' => $this->form,
                'success' => $sucesso,
                'columnVarcharUploadImage' => $columnVarcharUploadImage,
                'idColumns' => $idColumns
            )
        );
    }

    public function viewAction()
    {
        $idColumns = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idColumns) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getColumnsService()->selectById($idColumns);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        return new ViewModel(
            array_merge(
                array(
                    'id' => $data->getIdColumns()
                ),
                $this->getColumnsService()->extract($data)
            )
        );
    }

    public function deleteAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $columns = $this->getColumnsService();

        $delete = $columns->delete($identifier);

        if ($delete) {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 1));
        } else {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 0));
        }
    }

    public function listAction()
    {
        $formSearch = $this->getcolumnsSearchFactory();

        $redirectUrl = $this->url()->fromRoute(self::LISTS);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $formSearch->setData($prg);
        } else {
            $prg = array();
        }

        $columnsService = $this->getColumnsService();

        return new ViewModel(
            array(
                'sucesso'   => $this->viewMessages()->listSuccess(),
                'search'    => $formSearch,
                'tableService' => $columnsService,
                'orderBy'   => $columnsService->getOrderBy(),
                'order'     => $columnsService->getOrder(),
                'data'      => $columnsService->getData($prg),
            )
        );
    }

    public function getImagemService()
    {
        if (!isset($this->imagemService)) {
            $this->imagemService =
            $this->getServiceLocator()->get('ImagemUpload\Service\ImagemService');
        }
        return $this->imagemService;
    }
}
