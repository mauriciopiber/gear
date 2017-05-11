#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUploadImage"
type="web"
construct=()
construct+=("mvc-basic-upload-image/mvc-bsc-upl.yml;mvc-basic-upload-image/mvc_bsc_upl.php")


source "$bin/gear/module/test-module.sh"
