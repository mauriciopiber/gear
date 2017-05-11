#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcConstraints"
type="web"
construct=()
construct+=("mvc-basic-nullable/mvc-bsc-nul.yml;mvc-basic-nullable/mvc_bsc_nul.php")
construct+=("mvc-basic-unique/mvc-bsc-uni.yml;mvc-basic-unique/mvc_bsc_uni.php")
construct+=("mvc-basic-nullable-unique/mvc-bsc-nul-uni.yml;mvc-basic-nullable-unique/mvc_bsc_nul_uni.php")


source "$bin/gear/module/test-module.sh"
