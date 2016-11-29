#!/bin/bash

#### MODULE INFO

module="ModuleCli"
moduleUrl="module-cli"
base="/var/www/gear-package"

function tearDown {
    
    module=${1}
    modulepath=${2}

    cd $modulepath && php public/index.php gear git repository delete $module --force
    cd $modulepath && php public/index.php gear jenkins suite delete

    sudo rm -R $modulepath/.git
    sudo rm -R $modulepath/schema

}


function complete {

    module=${1}
    modulepath=${2}
    
    if [ "$module" == "" ***REMOVED***; then
    
        exit 1
    
    fi
    
    if [ "$modulepath" == "" ***REMOVED***; then
    
        exit 1
    
    fi    

    cd $modulepath && php public/index.php gear git repository create $module
    cd $modulepath && php public/index.php gear git repository init
    cd $modulepath && php public/index.php gear jenkins suite create module-cli
    cd $modulepath && php public/index.php gear deploy build "Primeiro Build com sucesso"


}

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)
modulepath="$base/$moduleUrl"
gearpath="$base/gear"

#### TEAR DOWN

tearDown $module $modulepath

#### Create

cd $gearpath && sudo php public/index.php gear module-as-project create $module $base --type=cli --force

cd $modulepath && sudo script/deploy-development.sh

#### COMPLETE.

complete $module $modulepath






