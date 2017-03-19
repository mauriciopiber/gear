#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-project.sh"

project="ProjectMvc"

deleteProject "$project"

createProject "$project"

createModuleCli "$project" "MyProjectModuleCli"
createModuleWeb "$project" "MyProjectModuleWeb"
createModuleWeb "$project" "MyProjectModuleMvc"

constructModuleProject "$project" "MyProjectModuleCli" "$scriptDir" "module-cli.yml"
constructModuleProject "$project" "MyProjectModuleWeb" "$scriptDir" "module-web.yml"

prepareConstruct "$project" "$scriptDir/20160123222068_all_columns.php"
constructModuleProject "$project" "MyProjectModuleMvc" "$scriptDir" "module-mvc.yml"

reload "$project"
testProject "$project"
