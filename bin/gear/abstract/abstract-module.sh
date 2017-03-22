#!/bin/bash
# ABSTRACT MODULE
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"


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
    scriptDir=${3}
    gearfile=${4}
    migration=${5}
    shouldTestLocal=${6}
    shouldTestCI=${7}
    shouldIntegrate=${8}

    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	tearDownCi "$module" "$modulePath"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	tearDownVersion "$module" "$modulePath"
    fi
    
    removeModule "$module"
    
    constructModule "$module" "$type"
    
    Gear_Module_Construct "$module" "$type" "$scriptDir" "$gearfile" "$migration" "0" "0"
    
    if [ "$shouldTestLocal" == "1" ***REMOVED***; then 
    	runModuleTest "$module" "$type"
    fi 
    
    if [ "$shouldTestCI" == "1" ***REMOVED***; then
    	setUpCi "$module" "$modulePath" "module-$type"
    fi
   
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	setUpVersion "$module" "$modulePath"
    fi 
   
    if [ "$shouldTestCI" == "1" ***REMOVED*** || [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	build "$module" "$modulePath" "$shouldIntegrate"
    fi
}


function Gear_Module_Reset
{
	# Params
	if [ $# -lt 3 ***REMOVED***; then
        echo "usage: module shouldTestLocal shouldTestCI"
        exit 1
    fi
   
    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    	
    cd $modulePath 
    sudo php public/index.php gear schema delete $module --basepath=$basePath
    sudo php public/index.php gear schema create $module --basepath=$basePath	
}

function Gear_Module_Construct
{
    if [ $# -ne 7 ***REMOVED***; then
        echo "usage: module type scriptDir gearfile migration testLocal testCI"
        exit 1
    fi

    # PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    
    type=${2}
    scriptDir=${3}
    gearfile=${4}
    migration=${5}

    # COPY GEARFILE
    copyGearfile "$scriptDir" "$gearfile" "$modulePath"

    if [ "$migration" != "" ***REMOVED***; then
    	copyMigration "$scriptDir" "$migration" "$modulePath"
    	prepareForDb "$modulePath"
    fi
   
    construct "$modulePath" "$module" "$basePath" "$type" "$gearfile"
}


function construct
{
	modulePath=${1}
	module=${2}
	basePath=${3}
	type=${4}
	gearfile=${5}
	
    cd $modulePath 
    sudo php public/index.php gear module construct $module $basePath --file=$gearfile
    
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
    sudo php public/index.php gear module-as-project create $module $basePath --type=$type --force --staging="${moduleUrl}.$(getStaging)"
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
