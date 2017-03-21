#!/bin/bash

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"
source "$headersDir/abstract-project.sh"

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"


project="ProjectMvc"
modules="MyProjectModuleCli;cli;module-cli.yml|"\
"MyProjectModuleWeb;web;module-web.yml|"\
"MyProjectModuleMvc;web;module-mvc.yml;20160123222068_all_columns.php"


Gear_CreateProject "$project" "$modules" $scriptDir "1" "0" "0"
