#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

project="ProjectMvc"

/bin/bash "$bin/gear/project/gear-project" "reset" "$project" "MyProjectModuleCli|MyProjectModuleWeb|MyProjectModuleMvc" "0" "0"
