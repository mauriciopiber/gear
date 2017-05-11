#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBscUpl"
type="web"
construct=()
construct+=("mvc-bsc-upl.yml;mvc_bsc_upl.php")

source "$bin/gear/module/test-module.sh"
