#!/bin/bash


here=$(pwd)

module=${1}

if [ "$module" == "" ***REMOVED***; then
	
	module="ModuleCli"
	
fi

moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< "$module")

echo "$module"
echo "$moduleUrl"

basepath="/var/www/gear-package"
modulepath="$basepath/$moduleUrl"

sudo rm -R $modulepath

sudo php public/index.php gear module-as-project create $module $basepath --type=cli --force

cd $modulepath && sudo script/deploy-development.sh

#cd $modulepath && sudo php public/index.php gear module diagnostic $module $basepath --type=cli

cp "$here/test/integration/local/module-cli/cli.yml" "$modulepath/gearfile.yml"


cd $modulepath && sudo php public/index.php gear module construct $module $basepath
cd $modulepath && ant phpcs phpmd phpcpd unit

