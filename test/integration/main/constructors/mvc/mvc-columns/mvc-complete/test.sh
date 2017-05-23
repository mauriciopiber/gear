#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumnsComplete"
type="web"
construct=()
construct+=("mvc-columns-complete.yml;mvc_columns_complete.php")

source "$bin/gear/module/test-module.sh"
