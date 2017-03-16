#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-web.sh"

removeModule "ModuleMvc"

constructModuleWeb "ModuleMvc"

runConstructDb "ModuleMvc" "$scriptDir/db.yml" "$scriptDir/20160123222068_all_columns.php"