#!/bin/bash
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

project="ProjectMvc"
modules="MyProjectModuleCli;cli;module-cli.yml|"\
"MyProjectModuleWeb;web;module-web.yml|"\
"MyProjectModuleMvc;web;module-mvc.yml;20160123222068_all_columns.php"

/bin/bash "$bin/gear/project/gear-project" "create" "$project" "$modules" "$scriptDir" "1" "0" "0"
