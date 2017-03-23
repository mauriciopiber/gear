#!/bin/bash
bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../ && pwd )"
cmd=${1}

if [ "$cmd" == "create" ***REMOVED***; then
    /bin/bash "$bin/gear/project/gear-project" "create" "$project" "$modules" "$scriptDir" "1" "0" "0"	
	exit 0
fi
	

if [ "$cmd" == "build" ***REMOVED***; then
    /bin/bash "$bin/gear/project/gear-project" "create" "$project" "$modules" "$scriptDir" "0" "1" "0"		
	exit 0	
fi	


if [ "$cmd" == "full" ***REMOVED***; then
	/bin/bash "$bin/gear/project/gear-project" "create" "$project" "$modules" "$scriptDir" "0" "1" "1"	
	exit 0
fi


if [ "$cmd" == "constr" ***REMOVED***; then
	/bin/bash "$bin/gear/project/gear-project" "construct" "$project" "$modules" "$scriptDir" "1" "0"
	exit 0
fi


if [ "$cmd" == "reset" ***REMOVED***; then
    /bin/bash "$bin/gear/project/gear-project" "reset" "$project" "$modulesClear" "0" "0"
    exit 0	
	
fi


if [ "$cmd" == "reload" ***REMOVED***; then
	/bin/bash "$bin/gear/project/gear-project" "construct" "$project" "$modules" "$scriptDir" "1" "0"
	exit 0	
	
fi

exit 1