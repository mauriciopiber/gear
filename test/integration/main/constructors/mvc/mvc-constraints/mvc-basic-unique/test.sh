#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBscUni"
type="web"
construct=()
construct+=("mvc-bsc-uni.yml;mvc_bsc_uni.php")

source "$bin/gear/module/test-module.sh"
