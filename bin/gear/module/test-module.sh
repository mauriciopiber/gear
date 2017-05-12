#!/bin/bash
bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../ && pwd )"

cmd=${1}
build=${2}

if [ "${construct[****REMOVED***}" == "" ***REMOVED***; then
	
	construct=()
	construct[0***REMOVED***="$gearfile;$migration"
	
fi 

if [ "$cmd" == "restore" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "restore" "$module" "$type"
	exit 0
fi

if [ "$cmd" == "create" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "create" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "1" "0" "0"
	exit 0
fi

if [ "$cmd" == "integrate" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "integrate" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "1" "1"
	exit 0
fi

if [ "$cmd" == "single-construct" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$type" "$scriptDir" "${build[****REMOVED***}" "1" "1"
	exit 0
fi

if [ "$cmd" == "build" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "create" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "0" "1" "0"
	exit 0	
fi

if [ "$cmd" == "full" ***REMOVED***; then
	/bin/bash "$bin/gear/module/gear-module" "create" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "0" "1" "1"
	exit 0	
fi

if [ "$cmd" == "reset" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "reset" "$module" "0" "0"
	exit 0	
fi

if [ "$cmd" == "clear" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "clear" "$module" "$type" "0" "0"
	exit 0	
fi

if [ "$cmd" == "diagnostic" ***REMOVED***; then
	/bin/bash "$bin/gear/module/gear-module" "diagnostic" "$module" "$type"
	exit 0	
fi

if [ "$cmd" == "upgrade" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "upgrade" "$module" "$type"
	exit 0	
fi

if [ "$cmd" == "construct" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "0" "0"
	exit 0	
fi

if [ "$cmd" == "reload" ***REMOVED***; then
	/bin/bash "$bin/gear/module/gear-module" "reset" "$module" "0" "0"
	/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "0" "0"
	exit 0	
fi


if [ "$cmd" == "test" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "test" "$module" "$type" "$build"
	exit 0	
fi

if [ "$cmd" == "reload-test" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "reset" "$module" "0" "0"
	/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "0" "0"	
	/bin/bash "$bin/gear/module/gear-module" "test" "$module" "$type" "$build"
	exit 0	
fi

if [ "$cmd" == "clear-test" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "clear" "$module" "$type" "0" "0"
	/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "0" "0"	
	/bin/bash "$bin/gear/module/gear-module" "test" "$module" "$type" "$build"
	exit 0	
fi

if [ "$cmd" == "reconstruct" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "reconstruct" "$module" "$type" "$scriptDir" "${construct[****REMOVED***}" "0" "0"
    /bin/bash "$bin/gear/module/gear-module" "test" "$module" "$type" "$build"	
	exit 0	
fi

echo "Command $cmd is not defined"
exit 1
