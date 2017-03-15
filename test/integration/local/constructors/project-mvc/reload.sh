#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../_functions && pwd )"

source "$headersDir/abstract-project.sh"

project="ProjectMvc"

removeModuleFromProject "$project" "MyProjectModuleCli"
removeModuleFromProject "$project" "MyProjectModuleWeb"
removeModuleFromProject "$project" "MyProjectModuleMvc"

exit 1


#constructModuleProject "$project" "MyProjectModuleCli" "$scriptsDir/module-cli.yml"

#constructModuleProject "$project" "MyProjectModuleWeb" "$scriptsDir/module-web.yml"

#prepareConstruct "$project" "$scriptsDir/20160123222068_all_columns.php"

#constructModuleProject "$project" "MyProjectModuleMvc" "$scriptsDir/module-mvc.yml"

#reload "$project"

#testProject "$project"





