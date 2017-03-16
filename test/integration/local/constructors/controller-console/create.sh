#!/bin/bash

#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../_functions && pwd )"

source "$headersDir/abstract-cli.sh"

removeModule "ControllerCli"
constructModuleCli "ControllerCli"
runConstructCli "ControllerCli" "$scriptDir/gear-console.yml"