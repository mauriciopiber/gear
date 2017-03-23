#!/bin/bash
bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../ && pwd )"
cmd=${1}

if [ "$cmd" == "create" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "create" "$module" "$type" "$scriptDir" "$gearfile" "$migration" "1" "0" "0"
	exit 0
fi

if [ "$cmd" == "build" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "create" "$module" "$type" "$scriptDir" "$gearfile" "$migration" "0" "1" "0"
	exit 0	
fi

if [ "$cmd" == "full" ***REMOVED***; then
	/bin/bash "$bin/gear/module/gear-module" "create" "$module" "$type" "$scriptDir" "$gearfile" "$migration" "0" "1" "1"
	exit 0	
fi

if [ "$cmd" == "reset" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "reset" "$module" "0" "0"
	exit 0	
fi

if [ "$cmd" == "constr" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$type" "$scriptDir" "$gearfile" "$migration" "0" "0"
	exit 0	
fi

if [ "$cmd" == "reload" ***REMOVED***; then
	/bin/bash "$bin/gear/module/gear-module" "reset" "$module" "0" "0"
	/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$type" "$scriptDir" "$gearfile" "$migration" "0" "0"
	exit 0	
fi


if [ "$cmd" == "test" ***REMOVED***; then
	
	/bin/bash "$bin/gear/module/gear-module" "test" "$module" "$type"
	exit 0	
fi

if [ "$cmd" == "reload-test" ***REMOVED***; then
	/bin/bash "$bin/gear/module/gear-module" "reset" "$module" "0" "0"
	/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$type" "$scriptDir" "$gearfile" "$migration" "0" "0"	
	/bin/bash "$bin/gear/module/gear-module" "test" "$module" "$type"
	exit 0	
fi
