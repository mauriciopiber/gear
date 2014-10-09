<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;

class HappyController extends AbstractConsoleController
{
    public function danceAction()
    {
        $request = $this->getRequest();

        $dance = $this->getServiceLocator()->get('danceRepository');
        $danca = '';

        for ($i = 0; $i < $request->getParam('steps', 4); $i++) {

            $aleatorio = rand(0,10);

            $divisor = $aleatorio%4;

            if ($divisor == 0) {
                $danca .= $dance->getEsquerda();
            } elseif ($divisor == 1) {
                $danca .= $dance->getDireita();
            } elseif ($divisor == 2) {
                $danca .= $dance->getAberto();
            } elseif ($divisor == 3) {
                $danca .= $dance->getFechado();
            }
        }

        return $danca;
    }
}
