#!/bin/bash

set -ex

headerDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
#basedir=$(dirname "$0")
#fullpath=$(realpath $basedir)

#echo "Testing SRC - CONSOLE"

#base="/var/www/gear-package"
function moduleName
{
    if [ "${1}" == "" ***REMOVED***; then
    	
        echo "Module"
        return	
    	
    fi	
	
	echo "${1}"
}

function moduleUrl
{
    echo $(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< "${1}")	
}

function basepath
{
    basepath="/var/www/gear-package"
    echo "$basepath"	
}


function modulepath
{
	
    file="$(basepath)/${1}"
    echo $file
}


function staging
{
	
    echo "stag01.pibernetwork.com"
}