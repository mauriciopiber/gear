#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbxColumns"
type="web"
migration="20160123222067_columns.php"
gearfile="db.yml"
build=${2}

source "$bin/gear/module/test-module.sh"
