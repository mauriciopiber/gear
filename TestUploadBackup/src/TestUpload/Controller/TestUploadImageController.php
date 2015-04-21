<?php
namespace TestUpload\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use TestUpload\Factory\TestUploadImageFactoryTrait;
use TestUpload\Service\TestUploadImageServiceTrait;
use TestUpload\Factory\TestUploadImageSearchFactoryTrait;

class TestUploadImageController extends AbstractActionController
{
    const CREATE = 'test-upload/test-upload-image/create';
    const EDIT   = 'test-upload/test-upload-image/edit';
    const LISTS  = 'test-upload/test-upload-image/list';
    const IMAGE  = 'test-upload/test-upload-image/upload-image';

    use TestUploadImageFactoryTrait;
    use TestUploadImageServiceTrait;
    use TestUploadImageSearchFactoryTrait;


    public function createAction()
    {
        $sessionImagem = new \Zend\Session\Container('imageTestUploadImage');
        if (!isset($sessionImagem->metaImagem)) {
            $sessionImagem->metaImagem = array();
        }

        $form    = $this->getTestUploadImageFactory();
        $service = $this->getTestUploadImageService();

        $redirectUrl = $this->url()->fromRoute(self::CREATE);
        $prg = $this->filePostRedirectGet($form, $redirectUrl, true);



        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {

            $post = $prg;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                $create = $service->create($data);
                if ($create) {
                    unset($sessionImagem->metaImagem);
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $create->getIdTestUploadImage(), 'success' => 1)
                    );
                }
            } else {
                $fileErrors = $form->get('image')->getMessages();
                var_dump($fileErrors);die();
                if (empty($fileErrors)) {
                    $sessionImagem->metaImagem['image'***REMOVED*** = $form->get('image')->getValue();
                }
            }
        }

        if (isset($sessionImagem->metaImagem['image'***REMOVED***)) {
            $image = $this->getImagemService()->resolveTmpImage($sessionImagem->metaImagem['image'***REMOVED***['tmp_name'***REMOVED***);
        } else {
            $image = '';
        }


        return (isset($view)) ? $view : new ViewModel(
            array(
                'image' => $image,
                'form' => $form,
            )
        );
    }

    public function editAction()
    {

        $idTestUploadImage = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idTestUploadImage) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getTestUploadImageService()->selectById($idTestUploadImage);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $form    = $this->getTestUploadImageFactory();
        $service = $this->getTestUploadImageService();

        $redirectUrl = $this->url()->fromRoute(self::EDIT, array('id' => $idTestUploadImage));

        $prg = $this->filePostRedirectGet($form, $redirectUrl, true);


        $image = '';


        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $post = $prg;
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $update = $service->update($idTestUploadImage, $data);

                if ($update) {
                    $view = $this->redirect()->toRoute(
                        self::EDIT,
                        array('id' => $update->getIdTestUploadImage(), 'success' => 1)
                    );
                }
            }
        } else {
            $data = $this->getTestUploadImageService()->selectById($idTestUploadImage);
            $form->bind($data);
        }


        if ($data instanceof \TestUpload\Entity\TestUploadImage && $data->getImage() !== null) {
            $image = str_replace('/public', '', sprintf($data->getImage(), 'pre'));
        }


        $sucesso = $this->getEvent()->getRouteMatch()->getParam('success', null);

        return (isset($view)) ? $view : new ViewModel(
            array(
                'form' => $form,
                'success' => $sucesso,
                'image' => $image,
                'idTestUploadImage' => $idTestUploadImage
            )
        );
    }

    public function viewAction()
    {
        $idTestUploadImage = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$idTestUploadImage) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $data = $this->getTestUploadImageService()->selectById($idTestUploadImage);

        if (!$data) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        return new ViewModel(
            array_merge(
                array(
                    'id' => $data->getIdTestUploadImage()
                ),
                $this->getTestUploadImageService()->extract($data)
            )
        );
    }

    public function deleteAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id', null);

        if (!$identifier) {
            return $this->redirect()->toRoute(self::LISTS);
        }

        $testUploadImage = $this->getTestUploadImageService();

        $delete = $testUploadImage->delete($identifier);

        if ($delete) {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 1));
        } else {
            return $this->redirect()->toRoute(self::LISTS, array('success' => 0));
        }
    }

    public function listAction()
    {
        $formSearch = $this->gettestUploadImageSearchFactory();

        $redirectUrl = $this->url()->fromRoute(self::LISTS);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg !== false) {
            $formSearch->setData($prg);
        } else {
            $prg = array();
        }

        $testUploadImageService = $this->getTestUploadImageService();

        return new ViewModel(
            array(
                'sucesso'   => $this->viewMessages()->listSuccess(),
                'search'    => $formSearch,
                'tableService' => $testUploadImageService,
                'orderBy'   => $testUploadImageService->getOrderBy(),
                'order'     => $testUploadImageService->getOrder(),
                'data'      => $testUploadImageService->getData($prg),
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
