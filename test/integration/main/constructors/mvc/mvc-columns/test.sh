#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumns"
type="web"
construct=()
construct+=("mvc-basic/mvc-basic.yml;mvc-basic/mvc_basic.php")


source "$bin/gear/module/test-module.sh"
