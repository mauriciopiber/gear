#!/bin/bash
# ABSTRACT MODULE
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"
source "$headersDir/abstract-docs.sh"
source "$headersDir/abstract-ci.sh"
source "$headersDir/abstract-version.sh"
source "$headersDir/module/util"
source "$headersDir/module/database"
source "$headersDir/module/module"

# 3. CRIA MÓDULO POR CLI DIRETO. FUNÇÃO SERÁ EXPORTADA PARA /bin PARA SER USADA COMO /vendor/bin
function Gear_Module_Execute_Create
{
    # Params
    if [ $# -ne 7 ***REMOVED***; then
        echo "usage: module type scriptDir construct shouldTestLocal shouldTestCI shouldIntegrate"
        exit 1
    fi
   
    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    
    type=${2}
    scriptDir=${3}
    construct=${4}
    
    shouldTestLocal=${5}
    shouldTestCI=${6}
    shouldIntegrate=${7}

    if [ "$shouldTestCI" == "1" ***REMOVED***; then
        Gear_CI_TearDown "$module" "$modulePath"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
        Gear_Version_TearDown "$module" "$modulePath"
    fi
    
    Gear_Module_Run_DeleteModule "$module"
    
    Gear_Module_Run_CreateModule "$module" "$type"
    Gear_Module_Run_InstallModule "$module"
    
    Gear_Module_Execute_Construct "$module" "$type" "$scriptDir" "$construct" "0" "0"
    
    if [ "$shouldTestLocal" == "1" ***REMOVED***; then 
        Gear_Module_Execute_Ant "$module" "$type"
    fi 
    
    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	Gear_CI_CopyJenkinsFile "$moduleUrl" "$modulePath" "0" "$type"
        Gear_CI_SetUp "$module" "$modulePath" "module-$type"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
        Gear_Version_SetUp "$module" "$modulePath"
    fi 
   
    if [ "$shouldTestCI" == "1" ***REMOVED*** || [ "$shouldIntegrate" == "1" ***REMOVED***; then
        Gear_CI_Build "$module" "$modulePath" "$shouldIntegrate"
    fi
   
    exit 0
}

function Gear_Module_Execute_Clear
{
    # Params
    if [ $# -lt 3 ***REMOVED***; then
        echo "usage: module shouldTestLocal shouldTestCI"
        exit 1
    fi
    
    basePath=$(Gear_Util_GetBasePath)

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    type=${2}
    
    if ! [[ -d $modulePath ***REMOVED******REMOVED***; then 
    	
    	return
    fi    
        
    cd $modulePath 

    # delete sensitive files
    Gear_Module_Delete_Constructor_Files "$modulePath"
    # renew database
    Gear_Module_Database_Up
    # run migrate
    Gear_Migrate
    # creates module again to assert all main files exist.
    Gear_Module_Run_CreateModule "$module" "$type"
}

function Gear_Module_Execute_Restore
{
    # Params
    if [ $# -lt 2 ***REMOVED***; then
        echo "usage: module type"
        exit 1
    fi
   
    module=$(Gear_Module_Util_GetModuleName "${1}")
    type=${2}
   
    Gear_Module_Run_CreateModule "$module" "$type"
}

function Gear_Module_Execute_Integrate
{
	    # Params
    if [ $# -ne 6 ***REMOVED***; then
        echo "usage: module type scriptDir construct shouldTestLocal shouldTestCI"
        exit 1
    fi
   
    basePath=$(Gear_Util_GetBasePath)
    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    
    type=${2}
    scriptDir=${3}
    construct=${4}
    
    Gear_Module_Run_DeleteModule "$module"
        
	echo "Running Integrate"
	
    Gear_Module_Run_CreateModule "$module" "$type"
    
    #composer update
    cd $modulePath && sudo composer update
    
    if [ "$type" == "web" ***REMOVED***; then
        sudo vendor/bin/install-nodejs
        sudo vendor/bin/virtualhost  $(pwd) $moduleUrl.gear.dev DEVELOPMENT
        sudo vendor/bin/install-db-module $moduleUrl.mysql.sql $module
        sudo vendor/bin/phinx migrate
        sudo vendor/bin/unload-module BjyAuthorize
    fi
   
    if [ "$type" == "cli" ***REMOVED***; then
        Gear_Module_Database_Up
    fi
    
    Gear_Module_Execute_Construct "$module" "$type" "$scriptDir" "$construct" "0" "0"

    sudo composer dump-autoload
    
    Gear_Module_Execute_Ant "$module" "$type"
}


function Gear_Module_Execute_Reset
{
    # Params
    if [ $# -lt 3 ***REMOVED***; then
        echo "usage: module shouldTestLocal shouldTestCI"
        exit 1
    fi
   
    # PARAMS
    basePath=$(Gear_Util_GetBasePath)

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
        
    if ! [[ -d $modulePath ***REMOVED******REMOVED***; then 
    	
    	return
    fi    
        
    cd $modulePath 
    vendor/bin/unload-module BjyAuthorize # @TODO REMOVE IT
    Gear_Module_Schema_Reset "$module"
    Gear_Module_Database_Up
}

function Gear_Module_Execute_Construct
{
    if [ $# -ne 6 ***REMOVED***; then
        echo "usage: module type scriptDir construct testLocal testCI"
        exit 1
    fi
   
    # PARAMS
    basePath=$(Gear_Util_GetBasePath)

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    
    type=${2}
    scriptDir=${3}
    construct=${4}

    if [ "$construct" == "" ***REMOVED***; then
    	echo "Missing Construct"
    	exit 1
    fi    
    #echo "Array size: ${#construct[****REMOVED***}"

    #echo "Array items:"
    for item in ${construct[****REMOVED***}
    do
    	
    	IFS=";"
        params=($item)
        
        gearfile=${params[0***REMOVED***}
        migration=${params[1***REMOVED***}
         
         # COPY GEARFILE
        Gear_Util_CopyGearfile "$scriptDir" "$gearfile" "$modulePath"

        if [ "$migration" != "" ***REMOVED***; then
            Gear_Util_CopyMigration "$scriptDir" "$migration" "$modulePath"
            Gear_Util_PrepareForDb "$modulePath"
        fi   
        Gear_Module_Run_Construct "$modulePath" "$module" "$basePath" "$type" "$(basename $gearfile)"
    done;
   
    if [ "$type" == "web" ***REMOVED***; then
        Gear_Module_Reload "$module"
    fi
}


function Gear_Module_Execute_Reconstruct
{
    if [ $# -ne 6 ***REMOVED***; then
        echo "usage: module type scriptDir construct testLocal testCI"
        exit 1
    fi
   
    # PARAMS
    basePath=$(Gear_Util_GetBasePath)

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    
    type=${2}
    scriptDir=${3}
    construct=${4}
    
    if [ "$construct" == "" ***REMOVED***; then
    	echo "Missing Construct"
    	exit 1
    fi
   
    Gear_Module_Schema_Reset "$module"    

    for item in ${construct[****REMOVED***}
    do
    	
    	IFS=";"
        params=($item)
        
        gearfile=${params[0***REMOVED***}
        migration=${params[1***REMOVED***}
        
        Gear_Util_CopyGearfile "$scriptDir" "$gearfile" "$modulePath"
        
        if [ "$migration" != "" ***REMOVED***; then
        	Gear_Module_Delete_Migrations "$modulePath"
            Gear_Util_CopyMigration "$scriptDir" "$migration" "$modulePath"
            Gear_Util_PrepareForDb "$modulePath"
        fi           
   
        Gear_Module_Run_Construct "$modulePath" "$module" "$basePath" "$type" "$(basename $gearfile)"
    done;
   
    if [ "$type" == "web" ***REMOVED***; then
        Gear_Module_Reload "$module"
    fi
}


function Gear_Module_Execute_Diagnostic
{
    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    type=${2}
    
    if [ "$useOwnConstructor" == "0" ***REMOVED***; then
        cd $modulePath    
    else
        cd $(Gear_Util_GetGearPath)
    fi
   
    basePath=$(Gear_Util_GetBasePath)
   
    #cd $modulePath
    #echo "$module $type"
    sudo php public/index.php gear module diagnostic $module $basePath --type=$type    
}



function Gear_Module_Execute_Upgrade
{
    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    type=${2}
    
    if [ "$useOwnConstructor" == "0" ***REMOVED***; then
        cd $modulePath    
    else
        cd $(Gear_Util_GetGearPath)
    fi
   
    basePath=$(Gear_Util_GetBasePath)
   
    #cd $modulePath
    #echo "$module $type"
    sudo php public/index.php gear module upgrade $module $basePath --type=$type
}


function Gear_Module_Execute_Custom
{
    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    
    cd $modulePath
    $(${2})
}


# Ok
function Gear_Module_Execute_Ant
{
    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    
    type=${2}
    build=${3}
    
    if [ "$build" != "" ***REMOVED***; then
    	cd $modulePath && ant $build
    	return
    fi 
    
    if [ "$type" == "cli" ***REMOVED***; then
        cd $modulePath && ant prepare parallel-lint phpcs phpmd phpcpd unit-coverage-ci
        return
    fi
   
    cd $modulePath && ant prepare parallel-lint phpcs phpmd phpcpd jshint unit-coverage-ci karma protractor
    return
}
