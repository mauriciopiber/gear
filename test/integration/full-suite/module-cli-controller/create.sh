#!/bin/bash

#### MODULE INFO

module="ModuleCliController"
moduleUrl="module-cli-controller"
base="/var/www/gear-package"
modulepath="$base/$moduleUrl"
gearpath="$base/gear"

source "$gearpath/test/integration/full-suite/functions.sh"

tearDown $module $modulepath

cd $gearpath && sudo php public/index.php gear module-as-project create $module $base --type=cli --force
cd $modulepath && sudo script/deploy-development.sh


cd $gearpath && cp test/integration/full-suite/module-cli-controller/gearfile.yml "$modulepath"
cd $modulepath && sudo php public/index.php gear module construct ModuleCliController "$base" 

cd $modulepath && sudo script/load.sh

ant phpcs
ant phpmd
ant phpcpd
ant unit
ant phpcs-docs

#complete $module $modulepath module-cli
