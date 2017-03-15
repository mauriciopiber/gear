#!/bin/bash
# ABSTRACT PROJECT

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"

function getPath
{
    project=${1}
    basepath=$(basepath)
    echo "$basepath/$project"
}


function createProject
{
    project=${1}
    basepath=$(basepath)
    projectPath=$(getPath "$project")
    sudo php public/index.php gear project create $project --basepath=$basepath --force
    
    cd $projectPath 
    sudo script/deploy-development.sh    
}

function createModuleWeb
{
    projectPath=$(getPath "${1}")
    module=${2}    

    cd $projectPath && sudo php public/index.php gear module create "$module" --type=web
}

function createModuleCli
{
    projectPath=$(getPath "${1}")
    module=${2}    
            
    cd $projectPath && sudo php public/index.php gear module create "$module" --type=cli
}

function reload
{
    projectPath=$(getPath "${1}")
    cd $projectPath
    sudo script/load.sh
    sudo php public/index.php gear database project dump
}

function testProject
{
    projectPath=$(getPath "${1}")
    cd $projectPath 
    ant prepare phpcs phpcs-docs phpmd phpcpd unit karma protractor 
}

function constructModuleProject
{
	
    # PARAMS
    basePath=$(basepath)
    projectPath=$(getPath "${1}")
    project=${1}
    module=${2}
    scriptsDir=${3}
    gearfileName=${4}

    # COPY GEARFILE
    copyGearfileProject "$scriptsDir/$gearfileName" "$projectPath/$gearfileName"

    # CONSTRUCT 
    constructInProject "$projectPath" "$module" "$gearfileName" 	
}


function prepareConstruct
{
	project=${1}
	projectPath=$(getPath "$project")
	migrations=${2}
	
	copyMigration "$projectPath" "$migrations"
	
	cd $projectPath
	
	sudo vendor/bin/phinx migrate
	vendor/bin/unload-module BjyAuthorize	
	sudo php public/index.php gear database fix
}


function copyGearfileProject
{
    cp "${1}" "${2}"	
}


function constructInProject
{
	projectPath=${1}
	module=${2}
	gearfileName=${3}
	
    cd $projectPath 
    sudo php public/index.php gear module construct $module --file=$gearfileName

} 

function removeModuleFromProject
{
    basePath=$(basepath)
    projectPath=$(getPath "${1}")
    module=${2}
    
    cd $projectPath
    sudo php public/index.php gear module delete "$module"	
	
	
}

function resetModuleInProject
{
    # PARAMS
    basePath=$(basepath)
    
    projectPath=$(getPath "${1}")
    module=${2}
    	
    cd $projectPath 
    vendor/bin/unload-module BjyAuthorize # @TODO REMOVE IT
    sudo php public/index.php gear schema delete $module
    sudo php public/index.php gear schema create $module	
}
