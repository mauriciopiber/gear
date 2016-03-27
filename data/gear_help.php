#!/usr/bin/env php
<?php
function getModules()
{
    $modules = require_once __DIR__.'/../config/application.config.php';

    $modulesNames = '';

    //carrega só os módulos gear, que estão na pasta module.
    //O processo de colocar testes na Vendor é realizado pelo "gear module deploy"

    foreach ($modules['modules'***REMOVED*** as $module) {

        if (is_dir(__DIR__.'/../module/'.$module)) {

            $moduleConfigFile = __DIR__.'/../module/'.$module.'/config/module.config.php';

            if (is_file($moduleConfigFile)) {

                $modulesNames .= "\n".$module;
            }
        }
    }

    echo $modulesNames;
}
getModules();