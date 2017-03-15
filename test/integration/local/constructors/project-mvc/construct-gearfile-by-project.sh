#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../_functions && pwd )"

source "$headersDir/abstract-project.sh"

project="ProjectMvc"

createProject "$project"
createModuleWeb "$project" "MyProjectModuleWeb"
createModuleCli "$project" "MyProjectModuleCli"
reload "$project"
testProject "$project"
