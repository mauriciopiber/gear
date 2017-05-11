#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcCmp"
type="web"
construct=()
construct+=("mvc-cmp.yml;mvc_cmp.php")

source "$bin/gear/module/test-module.sh"
