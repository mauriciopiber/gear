#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-project.sh"

# Params
project="ProjectWeb"

runCreateProject "$project"  
runCreateModuleProject "$project" "MyProjectModuleWeb" "web" "$scriptDir" "web.yml" 0
runCreateModuleProject "$project" "MyProjectModuleCli" "cli" "$scriptDir" "cli.yml" 0

# Flush & Test
reload "$project"
testProject "$project"