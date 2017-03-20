#!/bin/bash
# ABSTRACT MODULE
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"

# 3. CRIA MÓDULO POR CLI DIRETO. FUNÇÃO SERÁ EXPORTADA PARA /bin PARA SER USADA COMO /vendor/bin
function runCreateModule
{
	# Params
	if [ $# -ne 6 ***REMOVED***; then
        echo "usage: module type gearfile migration shouldTest shouldIntegrate"
        return
    fi

    module=$(moduleName "${1}")
    type=${2}
    gearfile=${3}
    migration=${4}
    shouldTest=${5}
    shouldIntegrate=${6}

    # Do the Work.    

    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	tearDown "$module"
    fi
    
    removeModule "$module"
    
    constructModule "$module" "$type"
    
    runConstruct "$module" "$type" "$gearfile" "$migration" ""
    
    if [ "$shouldTest" == "1" ***REMOVED***; then 
    	runModuleTest "$module" "$type"
    fi 
    
    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
    	setUp "$module" "$type"
    fi
}

function tearDown
{
	# PARAMS
    basePath=$(basepath)

    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    
	
	if ! [[ -d "$modulePath" ***REMOVED******REMOVED***; then
        echo "Module Not Created Yet"
        return 0
    fi
    
    cd $modulePath && php public/index.php gear git repository delete $module --force
    cd $modulePath && php public/index.php gear jenkins suite delete
    cd $modulePath && php public/index.php gear jira version delete "$moduleUrl-0.1.1"    
}

function setUp
{
    module=$(moduleName "${1}")
    moduleUrl=$(moduleUrl "$module")
    modulePath=$(modulepath "$moduleUrl")
    
    type=${2}

    cd $modulePath
    echo "repository create"
    sudo php public/index.php gear git repository create $module
    echo "repository init"
    sudo php public/index.php gear git repository init
    echo "jenkins create"
    sudo php public/index.php gear jenkins suite create module-$type
    echo "run scan"
    sudo php public/index.php gear jenkins job build "$moduleUrl" --indexing
    echo "create first version"
    vendor/bin/fast-release --hotfix "Fast Release" "Fast Release" "1h" "30" "19/03/2017 12:01:00" "19/03/2017 12:02:00"
    echo "build"
    sudo php public/index.php gear deploy build "Primeiro Build com sucesso $module $type" --hotfix
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
   
   if "$type" == "web" ***REMOVED***; then
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