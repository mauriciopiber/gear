#!/bin/bash

#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-web.sh"

module="ModuleWeb"

removeModule "$module"

constructModuleWeb "$module"

runConstructWeb "$module" "$scriptDir/web.yml"
