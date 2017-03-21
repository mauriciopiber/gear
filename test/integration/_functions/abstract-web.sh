#!/bin/bash
# ABSTRACT WEB

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract-module.sh"


function runConstructDb
{
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")

    # COPY GEARFILE
    copyGearfile "$modulePath" "${2}"
    copyMigration "$modulePath" "${3}"
    
    prepareForDb "$modulePath"
    
    # CONSTRUCT 
    constructWeb "$modulePath" "$module" "$basePath" 	
}

function runConstructWeb
{
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")

    # COPY GEARFILE
    copyGearfile "$modulePath" "${2}"

    # CONSTRUCT 
    constructWeb "$modulePath" "$module" "$basePath" 	
}


function constructWeb
{
	modulePath=${1}
	module=${2}
	basePath=${3}
	type=${4}
	
    cd $modulePath 
    sudo php public/index.php gear module construct $module $basePath
    sudo script/load.sh
    sudo php public/index.php gear database module dump $module
    ant prepare phpcs phpcs-docs phpmd phpcpd jshint unit karma protractor
}

function constructModuleWeb
{
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")

    sudo php public/index.php gear module-as-project create $module $basePath --type=web --force --staging="${moduleUrl}.$(staging)"
    cd $modulePath && sudo script/deploy-development.sh
}
