#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrUserTypeStrict"
type="web"
migration="20160123222068_simple_dates_table.php"
gearfile="db.yml"
build=${2}

source "$bin/gear/module/test-module.sh"
