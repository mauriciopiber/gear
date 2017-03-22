#!/bin/bash
# ABSTRACT PROJECT

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"

function gearPath
{
    echo "/var/www/gear-package/gear"	
	
}

function Gear_Project_Reset
{
	if [ $# -ne 4 ***REMOVED***; then
        echo "usage $0: project modules shouldTestLocal shouldTestCI"
        return
    fi
   
    project=${1}
    modules=${2}
    
    Gear_ResolveResetModules "$project" "$modules"
}

function Gear_Project_Construct
{
	# Params
	if [ $# -ne 5 ***REMOVED***; then
        echo "usage $0: project modules scriptDir shouldTestLocal shouldTestCI"
        return
    fi	
   
    project=${1}
    modules=${2}
    scriptDir=${3}
    
    Gear_ResolveConstructModules "$project" "$modules" "$scriptDir"

    reload "$project"	
}

function Gear_Project_Create
{
	# Params
	if [ $# -ne 6 ***REMOVED***; then
        echo "usage $0: project modules scriptDir shouldTestLocal shouldTestCI shouldIntegrate"
        return
    fi
   
	project=${1}
	modules=${2}
	scripts=${3}
	shouldTestLocal=${4}
    shouldTestCI=${5}
    shouldIntegrate=${6}

    projectPath=$(getPath "${project}")
    gearPath=$(gearPath)
    
    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	echo "tearDownCi"
   	    tearDownCi "$project" "$projectPath"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
        echo "tearDownVersion"
    	tearDownVersion "$project" "$projectPath"
    fi

    deleteProject "$project"
    
    cd $gearPath
    createProject "$project"
    
    if [ "$modules" != "" ***REMOVED***; then
    	Gear_ResolveCreateModules "$project" "$modules" "$scripts"
        reload "$project"	
    fi 
    
    if [ "$shouldTestLocal" == "1" ***REMOVED***; then
    	testProject "$project"
    fi 
    
    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	echo "configureCi"
    	setUpCi "$project" "$projectPath" "project-web"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	setUpVersion "$project" "$projectPath"
    fi 
   
    if [ "$shouldTestCI" == "1" ***REMOVED*** || [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	echo "build"
    	build "$project" "$projectPath" "$shouldIntegrate"
    fi
    
    
    #echo "$project $modules $scripts $shouldTestLocal $shouldTestCI $shouldIntegrate"
		
}

function Gear_ResolveResetModules
{
	project=${1}
	modules=${2}

	IFS="|"
    params=($modules)
    for key in "${!params[@***REMOVED***}"; do 
   
        moduleParams=${params[$key***REMOVED***}
        
        IFS=";"
        inputs=($moduleParams)
        Gear_Project_Module_Reset $project ${inputs[@***REMOVED***}
    
   done	
	
}

function Gear_ResolveConstructModules
{
	project=${1}
	modules=${2}
	scripts=${3}

	IFS="|"
    params=($modules)
    for key in "${!params[@***REMOVED***}"; do 
   
        moduleParams=${params[$key***REMOVED***}
        
        IFS=";"
        inputs=($moduleParams)
        Gear_Project_Module_Construct $project $scripts ${inputs[@***REMOVED***}
    
   done	
	
}


function Gear_ResolveCreateModules
{
	project=${1}
	modules=${2}
	scripts=${3}

	IFS="|"
    params=($modules)
    for key in "${!params[@***REMOVED***}"; do 
   
        moduleParams=${params[$key***REMOVED***}
        
        IFS=";"
        inputs=($moduleParams)
        Gear_Project_Module_Create $project $scripts ${inputs[@***REMOVED***}
    
   done
}


function Gear_Project_Module_Create
{
    # Params
	if [ $# -lt 5 ***REMOVED***; then
        echo "usage $0: project scriptDir module type gearfile migration"
        return
    fi
   
	project=${1}
	scriptDir=${2}
	module=${3}
	type=${4}
	gearfile=${5}
	migration=${6}
	
	projectPath=$(getPath "${project}")
	
    cd $projectPath 
    sudo php public/index.php gear module create "$module" --type=$type
    
    Gear_Project_Module_Construct "$project" "$scriptDir" "$module" "$gearfile" "$migration"
}

function Gear_Project_Module_Construct
{
	# Params
	if [ $# -lt 4 ***REMOVED***; then
        echo "usage $0: project scriptDir module gearfile migration shouldTest shouldCi"
        exit 1
    fi
   
    project=${1}
    scriptsDir=${2}
    module=${3}
    gearfile=${4}
    migration=${5}
      
    # PARAMS
    basePath=$(basepath)
    projectPath=$(getPath "${1}")

    if [ "$migration" != "" ***REMOVED***; then
    	copyMigration "$scriptsDir" "$migration" "$projectPath"
    	prepareForDb "$projectPath" 
    fi     

    # COPY GEARFILE
    copyGearfile "$scriptsDir" "$gearfile" "$projectPath"

    # CONSTRUCT 
    constructInProject "$projectPath" "$module" "$gearfile" 	
}

function getPath
{
    project=${1}
    basepath=$(basepath)
    echo "$basepath/$project"
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
    url=$(toUrl "$project")
    basepath=$(basepath)
    projectPath=$(getPath "$project")
    sudo php public/index.php gear project create $project --basepath=$basepath --force \
    --staging="${url}.$(getStaging)" \
    --production="${url}.$(getProduction)" 
    
    cd $projectPath 
    sudo script/deploy-development.sh    
}

function Gear_Project_Module_Reset
{
    project=${1}
    basepath=$(basepath)
    projectPath=$(getPath "$project")
    module=${2}
    
    
    cd $projectPath
    vendor/bin/unload-module BjyAuthorize # @TODO REMOVE IT
    sudo php public/index.php gear schema delete $module
    sudo php public/index.php gear schema create $module		
    sudo php public/index.php gear module load BjyAuthorize --after=ZfcUserDoctrineORM
}

function Cmd_ProjectCreateModule
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
    copyGearfile "$scriptsDir/gearfiles/$gearfileName" "$projectPath/$gearfileName"

    # CONSTRUCT 
    constructInProject "$projectPath" "$module" "$gearfileName" 	
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