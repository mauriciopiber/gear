#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

project="ProjectMvc"

/bin/bash "$bin/gear/project/gear-project" "reset" "$project" "MyProjectModuleCli|MyProjectModuleWeb|MyProjectModuleMvc" "0" "0"


# Params
project="ProjectMvc"
modules="MyProjectModuleCli;cli;module-cli.yml|"\
"MyProjectModuleWeb;web;module-web.yml|"\
"MyProjectModuleMvc;web;module-mvc.yml;20160123222068_all_columns.php"


/bin/bash "$bin/gear/project/gear-project" "construct" "$project" "$modules" "$scriptDir" "1" "0"
