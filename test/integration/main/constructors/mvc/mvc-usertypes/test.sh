#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUsertypes"
type="web"
construct=()
construct+=("mvc-basic-low-strict/mvc.yml;mvc-basic-low-strict/mvc_usertypes_basic_low_strict.php")
construct+=("mvc-basic-strict/mvc.yml;mvc-basic-strict/mvc_usertypes_basic_strict.php")


source "$bin/gear/module/test-module.sh"
