#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

module="ModuleCli"

/bin/bash "$bin/gear/module/gear-module" "create" "$module" "cli" "$scriptDir" "cli.yml" "" "1" "0" "0"

