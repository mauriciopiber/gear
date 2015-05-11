<?php
namespace Column\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use GearBase\Controller\PasswordVerifyTrait;
use GearBase\Controller\UploadImageTrait;
use Column\Factory\ColumnsFactoryTrait;
use Column\Service\ColumnsServiceTrait;
use Column\Factory\ColumnsSearchFactoryTrait;

class ColumnsController extends AbstractActionController
{
    const CREATE = 'column/columns/create';
    const EDIT   = 'column/columns/edit';
    const LISTS  = 'column/columns/list';
    const IMAGE  = 'column/columns/upload-image';

    use PasswordVerifyTrait;
    use UploadImageTrait;
    use ColumnsFactoryTrait;
    use ColumnsServiceTrait;
    use ColumnsSearchFactoryTrait;


    public function createAction()
    {
        $this->dropUploadImageSession();

        $this->form    = $this->getColumnsFactory();
        $this->service = $this->getColumnsService();
        $this->url     = self::CREATE;

        $this->getRequestPlugin()->addFilter(
            'columnVarcharPasswordVerify',
            $this->getPasswordVerifyFilter()
        );
        $create = $this->getRequestPlugin()->fileCreate();

        if ($create instanceof Response) {
            return $create;
        }

        if ($create) {
            $this->dropUploadImageSession();
            return $this->redirect()->toRoute(
                self::EDIT,
                array('id' => $create->getIdColumns(), 'success' => 1)
            );
        }

        $this->verifyErrors('columnVarcharUploadImage');
        $columnVarcharUpload = $this->getTempUpload('columnVarcharUploadImage');

        return new ViewModel(
            array(
                'columnVarcharUploadImage' => $columnVarcharUpload,
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

        $this->data = $this->getColumnsService()->selectById($idColumns);

        if (!$this->data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $this->form      = $this->getColumnsFactory();
        $this->service   = $this->getColumnsService();
        $this->url       = self::EDIT;
        $this->requestId = $idColumns;

        $this->getRequestPlugin()->addFilter(
            'columnVarcharPasswordVerify',
            $this->getPasswordVerifyFilter()
        );
        $update = $this->getRequestPlugin()->fileUpdate();
        if ($update instanceof Response) {
            return $update;
        }

        if ($update) {
            return $this->redirect()->toRoute(
                self::EDIT,
                array('id' => $update->getIdColumns(), 'success' => 1)
            );
        }

        $this->data = $this->getColumnsService()->selectById($idColumns);
        $this->data->setColumnVarcharPasswordVerify('');
        $this->form->bind($this->data);

        $columnVarcharUpload = $this->getUploadImagePath('getColumnVarcharUploadImage');

        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return new ViewModel(
            array(
                'form' => $this->form,
                'success' => $sucesso,
                'columnVarcharUploadImage' => $columnVarcharUpload,
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
                    'id' => $data->getIdColumns(),
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
        }

        return $this->redirect()->toRoute(self::LISTS, array('success' => 0));
    }

    public function listAction()
    {
        $this->form = $this->getcolumnsSearchFactory();
        $this->url  = self::LISTS;
        $this->post = array();

        $prg = $this->getRequestPlugin()->listFilter();

        if ($prg instanceof Response) {
            $prg;
        }

        $columns= $this->getColumnsService();

        return new ViewModel(
            array(
                'sucesso'   => $this->viewMessages()->listSuccess(),
                'search'    => $this->form,
                'tableService' => $columns,
                'orderBy'   => $columns->getOrderBy(),
                'order'     => $columns->getOrder(),
                'data'      => $columns->getData($this->post),
            )
        );
    }
}
