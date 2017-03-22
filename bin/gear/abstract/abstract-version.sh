#!/bin/bash

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"

function Gear_Version_SetUp
{
    name=${1}
    basePath=${2}

    cd $basePath
	echo "create first version"
    vendor/bin/fast-release --hotfix "Release $name" "Release $name" "1h" "30" "19/03/2017 12:01" "19/03/2017 12:02"
}

function Gear_Version_TearDown
{
	name=${1}
	basePath=${2}
	
	if [ -d "$basePath" ***REMOVED***; then
		
	    url=$(Gear_Util_ToUrl "$name")
        cd $basePath && php public/index.php gear jira version delete "$url-0.1.1"
    fi   	
}