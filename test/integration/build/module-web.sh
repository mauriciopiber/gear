#!/bin/bash

base="/var/www/gear-package"
modulepath="$base/my-module-web"
module="MyModuleWeb"
type="web"



ls -l $modulepath/schema/module.json &> /dev/null

if [ "${?}" == 0 ***REMOVED***; then
    sudo rm $modulepath/schema/module.json
    sudo rm $modulepath/build.xml
    sudo rm $modulepath/test/ant-*
fi

sudo php public/index.php gear module-as-project create $module $base --type=$type --force

cd $modulepath && sudo script/deploy-development.sh

cd $modulepath && ant namespace -Dnamespace=MyModuleWeb/Controller -DtestNamespace=MyModuleWebTest/ControllerTest

exit 1

cd $modulepath && ant dev
cd $modulepath && ant ci
cd $modulepath && ant measure
