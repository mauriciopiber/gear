#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUsertypes"
type="web"
construct=()
construct+=("mvc-basic-low-strict/mvc-bsc-lws.yml;mvc-basic-low-strict/mvc_bsc_lws.php")
construct+=("mvc-basic-strict/mvc-bsc-str.yml;mvc-basic-strict/mvc_bsc_str.php")


source "$bin/gear/module/test-module.sh"
