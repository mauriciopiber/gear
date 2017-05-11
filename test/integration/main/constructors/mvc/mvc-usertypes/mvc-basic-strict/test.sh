#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBscStr"
type="web"
construct=()
construct+=("mvc-bsc-str.yml;mvc_bsc_str.php")

source "$bin/gear/module/test-module.sh"
