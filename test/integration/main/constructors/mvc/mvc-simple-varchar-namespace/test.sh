#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbxVarchar"
type="web"
migration="20160123222068_simple_varchar_table.php"
gearfile="db.yml"

source "$bin/gear/module/test-module.sh"
