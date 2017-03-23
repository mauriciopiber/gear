#!/bin/bash

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"

function Gear_CI_SetUp
{
    name=${1}
    basePath=${2}
    type=${3}

    cd $basePath
    echo "repository create"
    sudo php public/index.php gear git repository create $name
    echo "repository init"
    sudo php public/index.php gear git repository init
    echo "jenkins create"
    sudo php public/index.php gear jenkins suite create $type
}


function Gear_CI_TearDown
{
	name=${1}
	basePath=${2}
    
    if [ -d "$basePath" ***REMOVED***; then
        cd $basePath 
        vendor/bin/unload-module BjyAuthorize
        php public/index.php gear git repository delete $name --force
        php public/index.php gear jenkins suite delete	
    fi
   
    
}

function Gear_CI_Build
{
	name=${1}
	basePath=${2}

	cd $basePath	    
    sudo php public/index.php gear deploy save "Primeiro Build com sucesso $name" 
    #"$increment"
    url=$(Gear_Util_ToUrl "$name")
    sudo php public/index.php gear jenkins job build "$url" --indexing	
}
