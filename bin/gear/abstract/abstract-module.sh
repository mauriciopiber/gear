#!/bin/bash
# ABSTRACT MODULE
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"
source "$headersDir/abstract-docs.sh"
source "$headersDir/abstract-ci.sh"
source "$headersDir/abstract-version.sh"

# 3. CRIA MÓDULO POR CLI DIRETO. FUNÇÃO SERÁ EXPORTADA PARA /bin PARA SER USADA COMO /vendor/bin
function Gear_Module_Create
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
    
    Gear_Module_Construct "$module" "$type" "$scriptDir" "$construct" "0" "0"
    
    if [ "$shouldTestLocal" == "1" ***REMOVED***; then 
        Gear_Module_Run_Ant "$module" "$type"
    fi 
    
    if [ "$shouldTestCI" == "1" ***REMOVED***; then
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

function Gear_Module_Clear
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
    type=${2}
    
    if ! [[ -d $modulePath ***REMOVED******REMOVED***; then 
    	
    	return
    fi    
        
    cd $modulePath 
        
    sudo rm -R schema
    sudo rm -R src/$module
    sudo rm -R test/unit/$moduleTest
            
    cd $(Gear_Util_GetGearPath) && sudo php public/index.php gear module-as-project create $module $basePath \
    --type=$type \
    --force \
    --staging="${moduleUrl}.$(Gear_Util_GetStaging)"
}

function Gear_Module_Integrate
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
        
    echo "$module $moduleUrl $type $scriptDir $construct"
	echo "Running Integrate"
	
	#create module
	cd $(Gear_Util_GetGearPath) && sudo php public/index.php gear module-as-project create $module $basePath \
    --type=$type \
    --force \
    --staging="${moduleUrl}.$(Gear_Util_GetStaging)"
    
    #composer update
    cd $modulePath && sudo composer update
    
    if [ "$type" == "web" ***REMOVED***; then
        cd $modulePath && sudo vendor/bin/install-nodejs
        cd $modulePath && sudo vendor/bin/virtualhost  $(pwd) $moduleUrl.gear.dev DEVELOPMENT
        cd $modulePath && sudo vendor/bin/install-db-module $moduleUrl.mysql.sql $module
        cd $modulePath && sudo vendor/bin/phinx migrate
        cd $modulePath && sudo vendor/bin/unload-module BjyAuthorize
    fi
    
    Gear_Module_Construct "$module" "$type" "$scriptDir" "$construct" "0" "0"

    sudo composer dump-autoload
    
    Gear_Module_Run_Ant "$module" "$type"
}


function Gear_Module_Reset
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
    sudo php public/index.php gear schema delete $module --basepath=$basePath
    sudo php public/index.php gear schema create $module --basepath=$basePath    
    sudo php public/index.php gear schema controller create $module "IndexController" --basepath=$basePath --service="factories"
    sudo php public/index.php gear schema activity create $module "IndexController" "Index" --basepath=$basePath
    
    database=$(php -r '$global = require_once("config/autoload/global.php"); echo $global["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["dbname"***REMOVED***;')
    username=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["user"***REMOVED***;')
    password=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["password"***REMOVED***;')


    echo "Deploy Develoment - Migrations/DB"
    vendor/bin/database $database $username $password
}

function Gear_Module_Construct
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


function Gear_Module_Run_Construct
{
    modulePath=${1}
    module=${2}
    basePath=${3}
    type=${4}
    gearfile=${5}
    ignore=${6}
    
    if [ "$useOwnConstructor" == "0" ***REMOVED***; then
        cd $modulePath    
    else
        cd $(Gear_Util_GetGearPath)
    fi
     
    sudo php public/index.php gear module construct $module $basePath --file=$modulePath/$gearfile
}


function Gear_Module_Reload
{
    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    cd $modulePath
    
    sudo script/load.sh
    sudo php public/index.php gear database module dump $module    
    
}

function Gear_Module_Run_Ant
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
        cd $modulePath && ant prepare parallel-lint phpcs phpcs-docs phpmd phpcpd unit-coverage-ci
        return
    fi
   
    cd $modulePath && ant prepare parallel-lint phpcs phpcs-docs phpmd phpcpd jshint unit-coverage karma protractor
    return
}


function Gear_Module_Run_CreateModule
{
    # PARAMS
    basePath=$(Gear_Util_GetBasePath)

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    type=${2}

    cd $(Gear_Util_GetGearPath) && sudo php public/index.php gear module-as-project create $module $basePath \
    --type=$type \
    --force \
    --staging="${moduleUrl}.$(Gear_Util_GetStaging)"
    
    cd $modulePath && sudo script/deploy-development.sh
}


function Gear_Module_Run_DeleteModule
{
    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")

    if [ -d "$modulePath" ***REMOVED***; then
        sudo rm -R $modulePath
    fi
}

function Gear_Module_Util_GetModuleName
{
    if [ "${1}" == "" ***REMOVED***; then
        
        echo "Module"
        return    
        
    fi    
    
    echo "${1}"
}

function Gear_Module_Util_GetModuleUrl
{
    echo $(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< "${1}")    
}

function Gear_Module_Util_GetModulePath
{
    file="$(Gear_Util_GetBasePath)/${1}"
    echo $file
}
