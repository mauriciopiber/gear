#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBsc"
type="web"
construct=()
construct+=("mvc-bsc.yml;mvc_bsc.php")

source "$bin/gear/module/test-module.sh"
