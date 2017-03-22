#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

module="ModuleMvc"

/bin/bash "$bin/gear/module/gear-module" "reset" "$module" "0" "0"
/bin/bash "$bin/gear/module/gear-module" "construct" "$module" "$scriptDir" "db.yml" "20160123222068_all_columns.php" "0" "0"

