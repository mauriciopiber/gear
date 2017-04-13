#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

project="ProjectMvc"


/bin/bash "$bin/gear/project/gear-project-module" "reset" "$project" "MyProjectModuleCli" "0" "0"
/bin/bash "$bin/gear/project/gear-project-module" "reset" "$project" "MyProjectModuleWeb" "0" "0"
/bin/bash "$bin/gear/project/gear-project-module" "reset" "$project" "MyProjectModuleMvc" "0" "0"
