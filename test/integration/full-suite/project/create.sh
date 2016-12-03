#!/bin/bash

#### MODULE INFO

base="/var/www/gear-package"
gearpath="$base/gear"


project="ProjectModuleFour"
projectUrl="project-module-four"
projectpath="$base/$project"


source "$gearpath/test/integration/full-suite/functions.sh"

tearDownProject $project $projectpath

cd $gearpath && sudo php public/index.php gear project create $project --basepath=$base --force

cd $projectpath && sudo script/deploy-development.sh

cd $projectpath && sudo php public/index.php gear module create MyModuleCli --type=cli
cd $projectpath && sudo php public/index.php gear module create MyModuleWeb --type=web

cd $projectpath && sudo script/load.sh

#cd $projectpath && ant

complete $project $projectpath project-web
