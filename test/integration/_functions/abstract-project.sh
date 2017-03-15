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
	cd $projectPath && sudo script/load.sh
}

function testProject
{
	projectPath=$(getPath "${1}")
	cd $projectPath 
	ant prepare phpcs phpmd phpcpd unit karma protractor 
}