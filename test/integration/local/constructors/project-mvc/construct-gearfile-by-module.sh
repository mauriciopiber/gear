#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../_functions && pwd )"

source "$headersDir/abstract-project.sh"

project1="ProjectMvc"
module1="MyProjectModuleWeb"

runConstructProjectModuleWeb "$project1" "$module1" "$scriptDir/module-web.yml"


module1="MyProjectModuleCli"

runConstructProjectModuleCli "$project1" "$module1" "$scriptDir/module-web.yml"

createProject "$project"
createModuleWeb "$project" ""
createModuleCli "$project" "MyProjectModuleCli"
reload "$project"
testProject "$project"
