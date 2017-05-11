#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBscLws"
type="web"
construct=()
construct+=("mvc-bsc-lws.yml;mvc_bsc_lws.php")

source "$bin/gear/module/test-module.sh"
