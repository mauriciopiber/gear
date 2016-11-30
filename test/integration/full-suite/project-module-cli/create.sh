#!/bin/bash

#### MODULE INFO

base="/var/www/gear-package"
gearpath="$base/gear"


project="ProjectModuleCli"
projectUrl="project-module-cli"
projectpath="$base/$project"


source "$gearpath/test/integration/full-suite/functions.sh"

tearDown $project $projectpath

cd $gearpath && sudo php public/index.php gear project create $project --basepath=$base --force

cd $modulepath && sudo script/deploy-development.sh

cd $projectpath && sudo php public/index.php gear module create $module --type=cli

exit 1





### can be turned off
cd $modulepath && sudo vendor/bin/phinx migrate

### can be turned off
cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize

### can be turned off
cd $modulepath && sudo php public/index.php gear database fix

### can be turned off
cd $modulepath && sudo script/load.sh

complete $module $modulepath project-web