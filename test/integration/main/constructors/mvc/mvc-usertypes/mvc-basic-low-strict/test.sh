#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBasicLowStrict"
type="web"
construct=()
construct+=("mvc-basic-low-strict.yml;mvc_basic_low_strict.php")

source "$bin/gear/module/test-module.sh"
