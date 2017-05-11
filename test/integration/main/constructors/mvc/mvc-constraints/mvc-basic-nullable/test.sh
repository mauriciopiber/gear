#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBscNul"
type="web"
construct=()
construct+=("mvc-bsc-nul.yml;mvc_bsc_nul.php")

source "$bin/gear/module/test-module.sh"
