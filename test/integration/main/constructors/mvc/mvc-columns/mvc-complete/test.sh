#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcComplete"
type="web"
construct=()
construct+=("mvc-complete.yml;mvc_complete.php")

source "$bin/gear/module/test-module.sh"
