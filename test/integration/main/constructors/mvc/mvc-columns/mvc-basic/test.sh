#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBasic"
type="web"
construct=()
construct+=("mvc-basic.yml;mvc_basic.php")

source "$bin/gear/module/test-module.sh"
