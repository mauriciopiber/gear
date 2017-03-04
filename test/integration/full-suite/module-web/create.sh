#!/bin/bash

#### MODULE INFO

module="ModuleWeb"
moduleUrl="module-web"
base="/var/www/gear-package"
modulepath="$base/$moduleUrl"
gearpath="$base/gear"

source "$gearpath/test/integration/full-suite/functions.sh"

tearDown $module $modulepath

cd $gearpath && sudo php public/index.php gear module-as-project create $module $base --type=web --force --staging="module-web.stag01.pibernetwork.com"

cd $modulepath && sudo script/deploy-development.sh

### can be turned off
cd $modulepath && sudo vendor/bin/phinx migrate

### can be turned off
cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize

### can be turned off
cd $modulepath && sudo php public/index.php gear database fix

### can be turned off
cd $modulepath && sudo script/load.sh

complete $module $modulepath module-web

