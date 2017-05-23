#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumnsVarchar"
type="web"
construct=()
construct+=("mvc.yml;mvc_columns_varchar.php")

source "$bin/gear/module/test-module.sh"
