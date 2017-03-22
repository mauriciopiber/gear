#!/bin/bash
# ABSTRACT PROJECT

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"
source "$headersDir/abstract-docs.sh"
source "$headersDir/abstract-ci.sh"
source "$headersDir/abstract-version.sh"


function Gear_Project_Reset
{
	if [ $# -ne 4 ***REMOVED***; then
        echo "usage $0: project modules shouldTestLocal shouldTestCI"
        return
    fi
   
    project=${1}
    modules=${2}
    
    Gear_Project_ResolveModules_Reset "$project" "$modules"
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
    
    Gear_Project_ResolveModules_Construct "$project" "$modules" "$scriptDir"

    Gear_Project_Run_Reload "$project"	
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

    projectPath=$(Gear_Project_Util_GetProjectPath "${project}")
    
    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	echo "tearDownCi"
   	    Gear_CI_TearDown "$project" "$projectPath"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
        echo "tearDownVersion"
    	Gear_Version_TearDown "$project" "$projectPath"
    fi

    Gear_Project_Run_DeleteProject "$project"
    
    Gear_Project_Run_CreateProject "$project"
    
    if [ "$modules" != "" ***REMOVED***; then
    	Gear_Project_ResolveModules_Create "$project" "$modules" "$scripts"
        Gear_Project_Run_Reload "$project"	
    fi 
    
    if [ "$shouldTestLocal" == "1" ***REMOVED***; then
    	Gear_Project_Run_Ant "$project"
    fi 
    
    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	echo "configureCi"
    	Gear_CI_SetUp "$project" "$projectPath" "project-web"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	Gear_Version_SetUp "$project" "$projectPath"
    fi 
   
    if [ "$shouldTestCI" == "1" ***REMOVED*** || [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	echo "build"
    	Gear_CI_Build "$project" "$projectPath" "$shouldIntegrate"
    fi
    
    
    #echo "$project $modules $scripts $shouldTestLocal $shouldTestCI $shouldIntegrate"
		
}

function Gear_Project_ResolveModules_Reset
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

function Gear_Project_ResolveModules_Construct
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


function Gear_Project_ResolveModules_Create
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
	
	projectPath=$(Gear_Project_Util_GetProjectPath "${project}")
	
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
    basePath=$(Gear_Util_GetBasePath)
    projectPath=$(Gear_Project_Util_GetProjectPath "${1}")

    if [ "$migration" != "" ***REMOVED***; then
    	Gear_Util_CopyMigration "$scriptsDir" "$migration" "$projectPath"
    	Gear_Util_PrepareForDb "$projectPath" 
    fi     

    # COPY GEARFILE
    Gear_Util_CopyGearfile "$scriptsDir" "$gearfile" "$projectPath"

    # CONSTRUCT 
    Gear_Project_Run_Construct "$projectPath" "$module" "$gearfile" 	
}

function Gear_Project_Module_Reset
{
    project=${1}
    basepath=$(Gear_Util_GetBasePath)
    projectPath=$(Gear_Project_Util_GetProjectPath "$project")
    module=${2}
    
    
    cd $projectPath
    vendor/bin/unload-module BjyAuthorize # @TODO REMOVE IT
    sudo php public/index.php gear schema delete $module
    sudo php public/index.php gear schema create $module		
    sudo php public/index.php gear module load BjyAuthorize --after=ZfcUserDoctrineORM
}

function Gear_Project_Run_Reload
{
    projectPath=$(Gear_Project_Util_GetProjectPath "${1}")
    cd $projectPath
    sudo script/load.sh
    sudo php public/index.php gear database project dump
}

function Gear_Project_Run_Ant
{
    projectPath=$(Gear_Project_Util_GetProjectPath "${1}")
    cd $projectPath 
    #ant phpcs-docs
    ant prepare phpcs phpcs-docs phpmd phpcpd unit karma protractor 
}


function Gear_Project_Run_Construct
{
	projectPath=${1}
	module=${2}
	gearfileName=${3}
	
    cd $projectPath 
    sudo php public/index.php gear module construct $module --file=$gearfileName

} 

function Gear_Project_Util_GetProjectPath
{
    project=${1}
    basepath=$(Gear_Util_GetBasePath)
    echo "$basepath/$project"
}

function Gear_Project_Run_DeleteProject
{
	project=${1}
    projectPath=$(Gear_Project_Util_GetProjectPath "$project")
    
    if [ -d "$projectPath" ***REMOVED***; then
    	sudo rm -R $projectPath
    fi
}

function Gear_Project_Run_CreateProject
{
    project=${1}
    url=$(Gear_Util_ToUrl "$project")
    basepath=$(Gear_Util_GetBasePath)
    projectPath=$(Gear_Project_Util_GetProjectPath "$project")
    
    cd $(Gear_Util_GetGearPath)
    
    sudo php public/index.php gear project create $project --basepath=$basepath --force \
    --staging="${url}.$(Gear_Util_GetStaging)" \
    --production="${url}.$(Gear_Util_GetProduction)" 
    
    cd $projectPath 
    sudo script/deploy-development.sh    
}
