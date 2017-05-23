#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUsertypesBasicStrict"
type="web"
construct=()
construct+=("mvc.yml;mvc_usertypes_basic_strict.php")

source "$bin/gear/module/test-module.sh"
