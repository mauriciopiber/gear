#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcComplete"
type="web"
construct=()
construct+=("mvc-complete-strict-unique-nullable-upload-image/mvc-cmp-str-uni-nul-upl.yml;mvc-complete-strict-unique-nullable-upload-image/mvc_cmp_str_uni_nul_upl.php")


source "$bin/gear/module/test-module.sh"
