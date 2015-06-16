<?php
namespace Gear\Config;

use Gear\Service\AbstractJsonService;

class Navigation extends AbstractJsonService
{
    /**
     * @var string
     * @type class
     */
    protected $module;

    /**
     * @var string
     * @type url
     */
    protected $moduleUrl;


    /**
     * @var string
     * @type label
     */
    protected $moduleLabel;

    /**
     * @var array
     */
    protected $controllers;



    public function __construct($module, $moduleUrl, $moduleLabel, $controllers)
    {
        $this->module      = $module;
        $this->moduleUrl   = $moduleUrl;
        $this->moduleLabel = $moduleLabel;
        $this->controllers = $controllers;
    }

    public function render()
    {


        $navigation = <<<EOS
<?php
return array(
    'default' => array(
        array(
            'label' => '{$this->moduleLabel}',
            'route' => '{$this->moduleUrl}',
            'pages' => array(

EOS;

        if (!empty($this->controllers)) {
            foreach ($this->controllers as $controller) {

                $controllerLabel = $this->str('label', $controller->getNameOff());
                $controllerUrl   = $this->str('url', $controller->getNameOff());

                $navigation .= <<<EOS
                array(
                    'label' => '{$controllerLabel}',
                    'route' => '{$this->moduleUrl}/{$controllerUrl}',
                    'pages' => array(

EOS;

                if (!empty($controller->getActions())) {
                    foreach ($controller->getActions() as $action) {
                        $actionName = $this->str('label', $action->getName());
                        $actionUrl  = $this->str('url', $action->getRoute());

                        $navigation .= <<<EOS
                        array(
                            'label' => '{$actionName}',
                            'route' => '{$this->moduleUrl}/{$controllerUrl}/{$actionUrl}'
                        ),

EOS;
                    }
                }


                $navigation .= <<<EOS
                    ),
                ),

EOS;

            }
        }



        $navigation .= <<<EOS
            ),
        ),
    ),
);

EOS;
        return $navigation;

    }


}
