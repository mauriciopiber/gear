#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

project="ProjectMvc"

modules="MyProjectModuleCli;cli;module-cli.yml|"\
"MyProjectModuleWeb;web;module-web.yml|"\
"MyProjectModuleMvc;web;module-mvc.yml;20160123222068_all_columns.php"

modulesClear="MyProjectModuleCli|MyProjectModuleWeb|MyProjectModuleMvc"

source "$bin/gear/project/test-project.sh"
	
