#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcTxt"
type="web"
construct=()
construct+=("mvc-txt.yml;mvc_txt.php")

source "$bin/gear/module/test-module.sh"
