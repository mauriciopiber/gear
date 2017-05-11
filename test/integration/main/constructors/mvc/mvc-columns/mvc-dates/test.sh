#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcDts"
type="web"
construct=()
construct+=("mvc-dts.yml;mvc_dts.php")

source "$bin/gear/module/test-module.sh"
