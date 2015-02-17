<?php
namespace Gear\View\Helper;

use Zend\View\Helper\AbstractHelper;

class RouteConstraint extends AbstractHelper
{

    public function __invoke($action) {

        if ($action->getRoute() == 'list') {
           $data = $this->getView()->render('template/config/constraint-list.phtml');
        } elseif ($action->getRoute() == 'edit' || $action->getRoute() == 'delete') {
           $data = $this->getView()->render('template/config/constraint-id.phtml');
        } else {
            $data = '';
        }
        return $data;
    }


}
