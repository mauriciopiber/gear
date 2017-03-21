#!/bin/bash
# ABSTRACT MODULE
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"



#function Gear_Module_Construct
#{
	
	
#}

#function Gear_Module_Rest
#{

#}


# 3. CRIA MÓDULO POR CLI DIRETO. FUNÇÃO SERÁ EXPORTADA PARA /bin PARA SER USADA COMO /vendor/bin
function Gear_Module_Create
{
	# Params
	if [ $# -ne 8 ***REMOVED***; then
        echo "usage: module type scriptDir gearfile migration shouldTestLocal shouldTestCI shouldIntegrate"
        exit 1
    fi
   
    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    
    type=${2}
    gearfile=${3}
    migration=${4}
    shouldTestLocal=${5}
    shouldTestCI=${6}
    shouldIntegrate=${7}

    # Do the Work.    

    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	tearDownCi "$module" "$modulePath"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	tearDownVersion "$module" "$modulePath"
    fi
    
    removeModule "$module"
    
    constructModule "$module" "$type"
    
    runConstruct "$module" "$type" "$gearfile" "$migration"
    
    if [ "$shouldTestLocal" == "1" ***REMOVED***; then 
    	runModuleTest "$module" "$type"
    fi 
    
    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	setUpCi "$module" "$modulePath" "$type"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	setUpVersion "$module" "$modulePath"
    fi 
   
    if [ "$shouldTestCI" == "1" ***REMOVED*** || [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	build "$module" "$modulePath" "$shouldIntegrate"
    fi
}


function runConstruct
{
    if [ $# -ne 4 ***REMOVED***; then
        echo "usage: module type gearfile migration"
        return
    fi

    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    
    type=${2}
    gearfile=${3}
    migration=${4}

    # COPY GEARFILE
    copyGearfile "$modulePath" "$gearfile"

    if [ "$migration" != "" ***REMOVED*** && [ "$type" == "web" ***REMOVED***; then
    	copyMigration "$modulePath" "$migration"
    	prepareForDb "$modulePath"
    fi
   
    construct "$modulePath" "$module" "$basePath" "$type"
}


function prepareForDb
{
	cd ${1}
	sudo vendor/bin/phinx migrate
	vendor/bin/unload-module BjyAuthorize	
	sudo php public/index.php gear database fix
}

function construct
{
	modulePath=${1}
	module=${2}
	basePath=${3}
	type=${4}
	
    cd $modulePath 
    sudo php public/index.php gear module construct $module $basePath
    
    if [ "$type" == "web" ***REMOVED***; then
        sudo script/load.sh
        sudo php public/index.php gear database module dump $module	
    fi 
    
}

function runModuleTest
{
    module=${1}
    type=${2}
    
    if [ "$type" == "cli" ***REMOVED***; then
    	testModuleCli "$module"
    	return
    fi
   
   if [ "$type" == "web" ***REMOVED***; then
   	    testModuleWeb "$module"
   	    return
   fi	
	
}

function testModuleCli
{
	module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    
    cd $modulePath && ant prepare parallel-lint phpcs phpcs-docs phpmd phpcpd unit	
}

function testModuleWeb
{
	module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    
    cd $modulePath && ant prepare parallel-lint phpcs phpcs-docs phpmd phpcpd jshint unit karma protractor	
}

function constructModule
{
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    type=${2}

    cd $basePath/gear
    sudo php public/index.php gear module-as-project create $module $basePath --type=$type --force
    cd $modulePath && sudo script/deploy-development.sh
}


function removeModule
{
    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")

    if [ -d "$modulePath" ***REMOVED***; then
    	sudo rm -R $modulePath
    fi
}

function resetModule
{
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    	
    cd $modulePath 
    vendor/bin/unload-module BjyAuthorize # @TODO REMOVE IT
    sudo php public/index.php gear schema delete $module --basepath=$basePath
    sudo php public/index.php gear schema create $module --basepath=$basePath	
}