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

function Gear_Module_Clear_Repository
{
	for dir in ${1}/*; do

        if [[ -d $dir ***REMOVED******REMOVED***; then
        	rm -R "$dir"
        elif [[ -f $dir ***REMOVED******REMOVED***; then
            rm "$dir"
        else
            rm -rf "$dir"
        fi
    done
}

function Gear_Module_Repository_Clone
{
    # Params
    if [ $# -ne 4 ***REMOVED***; then
        echo "usage: module type scriptDir construct"
        exit 1
    fi

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")

    type=${2}
    scriptDir=${3}
    construct=${4}

    Gear_Module_Run_DeleteModule "$module"

    Gear_Git_Clone "$moduleUrl" "$modulePath"

    Gear_Module_Clear_Repository "$modulePath"

    Gear_Module_Run_CreateModule "$module" "$type"
    Gear_Module_Run_InstallModule "$module"

    Gear_Module_Execute_Construct "$module" "$type" "$scriptDir" "$construct" "0" "0"

    Gear_CI_CopyJenkinsFile "$moduleUrl" "$modulePath" "0" "$type"

    Gear_CI_Jenkins_Check  "$module" "$modulePath" "$type"

    Gear_Jenkins_Indexing "$module" "$modulePath"

    Gear_Git_Commit "$module" "$modulePath"
}

function Gear_Module_Repository_Start
{
    # Params
    if [ $# -ne 4 ***REMOVED***; then
        echo "usage: module type scriptDir construct"
        exit 1
    fi

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")

    type=${2}
    scriptDir=${3}
    construct=${4}

    Gear_Module_Run_DeleteModule "$module"

    Gear_Module_Run_CreateModule "$module" "$type"
    Gear_Module_Run_InstallModule "$module"

    Gear_Module_Execute_Construct "$module" "$type" "$scriptDir" "$construct" "0" "0"

    Gear_CI_CopyJenkinsFile "$moduleUrl" "$modulePath" "0" "$type"

    Gear_Git_Setup "$module" "$modulePath"

    Gear_Git_Commit "$module" "$modulePath"

    Gear_CI_Jenkins_Check  "$module" "$modulePath" "$type"

    Gear_Jenkins_Indexing "$module" "$modulePath"
}


function Gear_Module_Execute_Build_Suite
{
    # Params
    if [ $# -ne 4 ***REMOVED***; then
        echo "usage: module type scriptDir construct"
        exit 1
    fi

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    type=${2}
    scriptDir=${3}
    construct=${4}

    echo "Suite $module"

    # JENKINS

    #statusJenkins=$(Gear_CI_Jenkins_Check "$module" "$modulePath" "$type")

    #if [ $statusJenkins -gt 0 ***REMOVED***; then
    #    echo "Exiting due to Errors while providing Jenkins"
    #    exit 1
    #fi

    # Aqui deve ter um job no jenkins dedicado ao projeto.

    repositoryStatus=$(Gear_CI_Repository_Check "$module" "$modulePath")

    if [ $repositoryStatus -gt 1 ***REMOVED***; then
        echo "Exiting due to Errors while providing Repository"
        exit 1
    fi

       if [ "$repositoryStatus" == 0 ***REMOVED***; then
        Gear_Module_Repository_Clone "$module" "$type" "$scriptDir" "$construct"
    else
        Gear_Module_Repository_Start "$module" "$type" "$scriptDir" "$construct"
    fi
}

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

    types=("cli" "web" "api" "src-zf2")
    if [[ " ${types[@***REMOVED***} " =~ " ${type} " ***REMOVED******REMOVED***; then
        Gear_Module_Execute_Construct "$module" "$type" "$scriptDir" "$construct" "0" "0"
    fi



    if [ "$shouldTestLocal" == "1" ***REMOVED***; then
        Gear_Module_Execute_Ant "$module" "$type"
    fi

    if [ "$shouldTestCI" == "1" ***REMOVED***; then
        Gear_CI_CopyJenkinsFile "$moduleUrl" "$modulePath" "0" "$type"
        Gear_CI_SetUp "$module" "$modulePath" "$type"
    fi

    if [ "$shouldIntegrate" == "1" ***REMOVED***; then
        Gear_Version_SetUp "$module" "$modulePath"
    fi

    if [ "$shouldTestCI" == "1" ***REMOVED*** || [ "$shouldIntegrate" == "1" ***REMOVED***; then
        Gear_CI_Build "$module" "$modulePath" "$shouldIntegrate"
    fi

    exit 0
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
    cd $modulePath && `#sudo `composer update

    if [ "$type" == "web" ***REMOVED***; then
        `#sudo `vendor/bin/install-nodejs
        `#sudo `vendor/bin/virtualhost  $(pwd) $moduleUrl.gear.dev DEVELOPMENT
        `#sudo `vendor/bin/install-db-module $moduleUrl.mysql.sql $module
        `#sudo `vendor/bin/phinx migrate
        `#sudo `vendor/bin/unload-module BjyAuthorize
    fi

    if [ "$type" == "cli" ***REMOVED***; then
        Gear_Module_Database_Up
    fi

    Gear_Module_Execute_Construct "$module" "$type" "$scriptDir" "$construct" "0" "0"

    `#sudo `composer dump-autoload

    Gear_Module_Execute_Ant "$module" "$type"
}


function Gear_Module_SetUpJenkins
{
    # Params
    if [ $# -ne 2 ***REMOVED***; then
        echo "usage: module type"
        exit 1
    fi

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")
    type=${2}


    Gear_CI_CopyJenkinsFile "$moduleUrl" "$modulePath" "0" "$type"

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



function Gear_Module_Execute_Restore_Data
{
    # Params
    if [ $# -lt 2 ***REMOVED***; then
        echo "usage: module type"
        exit 1
    fi

    module=$(Gear_Module_Util_GetModuleName "${1}")
    type=${2}

    basePath=$(Gear_Util_GetBasePath)

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")

    cd $modulePath

    if [ -f "data/$moduleUrl.mysql.sql" ***REMOVED*** ; then
        `#sudo `rm data/$moduleUrl.mysql.sql
    fi
    Gear_Module_Database_Up
    `#sudo `vendor/bin/unload-module BjyAuthorize
    `#sudo `vendor/bin/phinx migrate
    #Gear_Module_Deploy_Up $module
    #`#sudo `php public/index.php gear database module dump $module
}

function Gear_Module_Execute_Restore_Module
{
    # Params
    if [ $# -lt 2 ***REMOVED***; then
        echo "usage: module type"
        exit 1
    fi

    basePath=$(Gear_Util_GetBasePath)

    module=$(Gear_Module_Util_GetModuleName "${1}")
    moduleUrl=$(Gear_Module_Util_GetModuleUrl "$module")
    modulePath=$(Gear_Module_Util_GetModulePath "$moduleUrl")

    type=${2}

    `#sudo `rm -R $modulePath/schema

    Gear_Module_Run_CreateModule "$module" "$type"
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

    cd $modulePath

    Gear_Module_Schema_Reset "$module"
    Gear_Module_Database_Up

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

    #if [ "$type" == "web" ***REMOVED***; then
        #Gear_Module_Reload "$module"
    #fi
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
    `#sudo `php public/index.php gear module diagnostic $module $basePath --type=$type
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
    `#sudo `php public/index.php gear module upgrade $module $basePath --type=$type
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

    cd $modulePath && ant phpunit phpunit-ci phpunit-coverage phpunit-coverage-ci
    cd $modulePath && ant dev
    cd $modulePath && ant ci
    cd $modulePath && ant measure

    exit 1


    if [ "$build" != "" ***REMOVED***; then
        cd $modulePath && ant $build
        return
    fi

    if [ "$type" == "cli" ***REMOVED***; then
        cd $modulePath && ant prepare parallel-lint phpcs phpmd phpcpd unit-coverage-ci
        return
    fi

    if [ "$type" == "src" ***REMOVED***; then
        cd $modulePath && ant prepare parallel-lint phpcs phpmd phpcpd unit
        return
    fi

    cd $modulePath && ant prepare parallel-lint phpcs phpmd phpcpd jshint unit-coverage-ci karma protractor
    return
}
