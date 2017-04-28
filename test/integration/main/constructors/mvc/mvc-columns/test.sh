#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumns"
type="web"
construct=()
construct+=("mvc-numeric/mvc-numeric.yml:mvc-numeric/mvc_numeric.php")


source "$bin/gear/module/test-module.sh"
