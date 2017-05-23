#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumnsNumeric"
type="web"
construct=()
construct+=("mvc-numeric.yml;mvc_columns_numeric.php")

source "$bin/gear/module/test-module.sh"
