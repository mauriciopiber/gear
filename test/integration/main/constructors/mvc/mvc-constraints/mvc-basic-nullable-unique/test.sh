#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBscNulUni"
type="web"
construct=()
construct+=("mvc-bsc-nul-uni.yml;mvc_bsc_nul_uni.php")

source "$bin/gear/module/test-module.sh"
