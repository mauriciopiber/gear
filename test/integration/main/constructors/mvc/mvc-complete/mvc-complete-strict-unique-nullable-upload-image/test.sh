#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcCmpStrUniNulUpl"
type="web"
construct=()
construct+=("mvc-cmp-str-uni-nul-upl.yml;mvc_cmp_str_uni_nul_upl.php")

source "$bin/gear/module/test-module.sh"
