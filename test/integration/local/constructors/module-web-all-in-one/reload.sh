#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../_functions && pwd )"

source "$headersDir/abstract-web.sh"

resetModule "ModuleAllInOne"
runConstructDb "ModuleAllInOne" "$scriptDir/db.yml" "$scriptDir/20160123222068_all_columns.php"

