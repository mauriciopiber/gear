#!/bin/bash
# ABSTRACT CLI

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/header.sh"

function not_in_array() {
    local haystack=${1}[@***REMOVED***
    local needle=${2}
    for i in ${!haystack}; do
        if [[ ${i} == ${needle} ***REMOVED******REMOVED***; then
            return 1
        fi
    done
    return 0
}

function tearDownCi
{
	name=${1}
	basePath=${2}
    
    if [ -d "$basePath" ***REMOVED***; then
        cd $basePath 
        php public/index.php gear git repository delete $name --force
        php public/index.php gear jenkins suite delete	
    fi
   
    
}

function tearDownVersion
{
	name=${1}
	basePath=${2}
	
	if [ -d "$basePath" ***REMOVED***; then
		
	    url=$(toUrl "$name")
        cd $basePath && php public/index.php gear jira version delete "$url-0.1.1"
    fi   	
}


function build
{
	name=${1}
	basePath=${2}

	cd $basePath	    
    sudo php public/index.php gear deploy save "Primeiro Build com sucesso $name" 
    #"$increment"
    url=$(toUrl "$name")
    sudo php public/index.php gear jenkins job build "$url" --indexing	
}

function setUpVersion
{
    name=${1}
    basePath=${2}

    cd $basePath
	echo "create first version"
    vendor/bin/fast-release --hotfix "Release $name" "Release $name" "1h" "30" "19/03/2017 12:01:00" "19/03/2017 12:02:00"
}

function setUpCi
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


function toUrl
{
    echo $(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< "${1}")	
}