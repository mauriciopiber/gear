#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

project="ProjectMvc"


/bin/bash "$bin/gear/project/gear-project-module" "reset" "$project" "MyProjectModuleCli" "0" "0"
/bin/bash "$bin/gear/project/gear-project-module" "construct" "$project" "$scriptDir" "MyProjectModuleCli" "module-cli.yml" "" "1" "0"


/bin/bash "$bin/gear/project/gear-project-module" "reset" "$project" "MyProjectModuleWeb" "0" "0"
/bin/bash "$bin/gear/project/gear-project-module" "construct" "$project" "$scriptDir" "MyProjectModuleWeb" "module-web.yml" "" "1" "0"

/bin/bash "$bin/gear/project/gear-project-module" "reset" "$project" "MyProjectModuleMvc" "0" "0"
/bin/bash "$bin/gear/project/gear-project-module" "construct" "$project" "$scriptDir" "MyProjectModuleMvc" "module-mvc.yml" "20160123222068_all_columns.php" "1" "0"
