#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcVrc"
type="web"
construct=()
construct+=("mvc-vrc.yml;mvc_vrc.php")

source "$bin/gear/module/test-module.sh"
