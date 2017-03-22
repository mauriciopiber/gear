#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

module="ModuleWeb"

/bin/bash "$bin/gear/module/gear-module" "create" "$module" "web" "$scriptDir" "web.yml" "" "0" "1" "0"

