#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrExample"
type="web"
migration="20170321222020_all_columns.php"
gearfile="gear-1.yml"

source "$bin/gear/module/test-module.sh"
