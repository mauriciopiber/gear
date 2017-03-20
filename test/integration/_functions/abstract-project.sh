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

# 1. CRIA MÓDULO POR CLI DIRETO. FUNÇÃO SERÁ EXPORTADA PARA /bin PARA SER USADA COMO /vendor/bin
function runCreateProject
{
	project=${1}
    deleteProject "$project"
    createProject "$project"
}

# 2. CRIA MÓDULO POR CLI DIRETO. FUNÇÃO SERÁ EXPORTADA PARA /bin PARA SER USADA COMO /vendor/bin
function runCreateModuleProject
{

    project=${1}
    module=${2}
    type=${3}
    scriptDir=${4}
    gearfile=${5}
    reload=${6}
    migration=${7}

    if [ "$type" == "web" ***REMOVED***; then
        createModuleWeb "$project" "$module"	
    fi
   
    if [ "$type" == "cli" ***REMOVED***; then
    	createModuleCli "$project" "$module"
    fi
   
    if [ "$reload" == "1" && "$migration" != "" ***REMOVED***; then
        reload "$project"
    fi
    
    constructModuleProject "$project" "$module" "$scriptDir" "$gearfile"
}

function deleteProject
{
	project=${1}
    basepath=$(basepath)
    projectPath=$(getPath "$project")
    
    if [ -d "$projectPath" ***REMOVED***; then
    	sudo rm -R $projectPath
    fi
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

function clearModuleProject
{
    project=${1}
    basepath=$(basepath)
    projectPath=$(getPath "$project")
    module=${2}
    
    
    cd $projectPath
    sudo php public/index.php gear schema delete $module
    sudo php public/index.php gear schema create $module		
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
    #ant phpcs-docs
    ant prepare phpcs phpmd phpcpd unit karma protractor 
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
    copyGearfileProject "$scriptsDir/gearfiles/$gearfileName" "$projectPath/$gearfileName"

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
    sudo cp "${1}" "${2}"	
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
