#!/bin/bash
# ABSTRACT PROJECT

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"


function createProject
{
	project=${1}
	basepath=$(basepath)
	projectPath="$basepath/$project"
    sudo php public/index.php gear project create $project --basepath=$basepath --force
    
    cd $projectPath 
    sudo script/deploy-development.sh	
}

function createModuleWeb
{
    project=${1}
    module=${2}
	basepath=$(basepath)
	projectPath="$basepath/$project"
	

    cd $projectPath && sudo php public/index.php gear module create "$module" --type=web
}

function createModuleCli
{
	project=${1}
    module=${2}	
	basepath=$(basepath)
	projectPath="$basepath/$project"
	
	cd $projectPath && sudo php public/index.php gear module create "$module" --type=cli
}

function reload
{
	project=${1}
	basepath=$(basepath)
	projectPath="$basepath/$project"	
	
	cd $projectPath && sudo script/load.sh
	
}

function testProject
{
    project=${1}
	basepath=$(basepath)
	projectPath="$basepath/$project"
	cd $projectPath && ant prepare phpcs phpmd phpcpd unit karma 
    cd $projectPath && ant protractor  
	
}