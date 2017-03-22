#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

project="ProjectMvc"

/bin/bash "$bin/gear/project/gear-project" "create" "$project" "" "$scriptDir" "0" "0" "0"

/bin/bash "$bin/gear/project/gear-project-module" "create" "$project" "$scriptDir" "MyProjectCli" "cli" "module-cli.yml" "" "1" "0" 
/bin/bash "$bin/gear/project/gear-project-module" "create" "$project" "$scriptDir" "MyProjectWeb" "web" "module-web.yml" "" "1" "0"
/bin/bash "$bin/gear/project/gear-project-module" "create" "$project" "$scriptDir" "MyProjectMvc" "web" "module-mvc.yml" "20160123222068_all_columns.php" "1" "0"
