#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUsertypes"
type="web"
construct=()
construct+=("mvc-basic-strict/mvc-basic-strict.yml:mvc-basic-strict/mvc_basic_strict.php")


source "$bin/gear/module/test-module.sh"
