#!/bin/bash


here=$(pwd)

project=${1}

if [ "$project" == "" ***REMOVED***; then
	
	project="ProjectWeb"
	
fi

projectUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< "$project")

echo "$project"
echo "$projectUrl"

basepath="/var/www/gear-package"
projectpath="$basepath/$project"

sudo rm -R $projectpath

sudo php public/index.php gear project create $project --basepath=$basepath --force

cd $projectpath && sudo script/deploy-development.sh
cd $projectpath && sudo php public/index.php gear module create MyProjectModuleCli --type=cli
#cd $projectpath && sudo php public/index.php gear module construct MyProjectCli


cd $projectpath && sudo php public/index.php gear module create MyProjectModuleWeb --type=web
#cd $projectpath && sudo php public/index.php gear module construct MyProjectWeb

cd $projectpath && sudo script/load.sh
#cd $projectpath && sudo php public/index.php gear project diagnostic $project $basepath --type=web

#cp "$here/test/integration/local/project-web/web.yml" "$projectpath/gearfile.yml"

#cd $projectpath && sudo php public/index.php gear project construct $project $basepath
cd $projectpath && ant prepare phpcs phpmd phpcpd unit karma 
cd $projectpath && ant protractor

