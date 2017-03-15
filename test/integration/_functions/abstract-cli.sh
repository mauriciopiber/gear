#!/bin/bash
# ABSTRACT CLI

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract-module.sh"

function runConstructCli
{
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")

    # COPY GEARFILE
    copyGearfile "$modulePath" "${2}"

    # CONSTRUCT 
    constructCli "$modulePath" "$module" "$basePath" 	
}

function constructCli
{
	modulePath=${1}
	module=${2}
	basePath=${3}
	type=${4}
	
    cd $modulePath 
    sudo php public/index.php gear module construct $module $basePath
    ant phpcs phpcs-docs phpmd phpcpd unit	
}

function constructModuleCli
{
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")

    sudo php public/index.php gear module-as-project create $module $basePath --type=cli --force
    cd $modulePath && sudo script/deploy-development.sh
}

function removeModule
{
    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")

    sudo rm -R $modulePath
}

function resetModule
{
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    	
    cd $modulePath 
    sudo php public/index.php gear schema delete $module $basePath
    sudo php public/index.php gear schema create $module $basePath	
}