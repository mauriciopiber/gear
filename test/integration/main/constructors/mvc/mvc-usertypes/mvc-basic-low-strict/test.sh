#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUsertypesBasicLowStrict"
type="web"
construct=()
construct+=("mvc-usertypes-basic-low-strict.yml;mvc_usertypes_basic_low_strict.php")

source "$bin/gear/module/test-module.sh"
