<?php
namespace Gear\View\Helper;

use Zend\View\Helper\AbstractHelper;

class RouteConstraint extends AbstractHelper
{

    public function __invoke($action) {


        if ($action->getRoute() == 'list') {


            $data =  PHP_EOL."
                                    'constraints' => array(
                                        'action' => '(?!\bpage\b)(?!\borderBy\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'page' => '[0-9***REMOVED***+',
                                        'orderBy' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'order' => 'ASC|DESC',
                                    ),

            ".PHP_EOL;

        } elseif ($action->getRoute() == 'edit' || $action->getRoute() == 'delete') {
            $data = PHP_EOL."
                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),

            ".PHP_EOL;

        } else {
            $data = '';
        }



        return $data;
    }


}
