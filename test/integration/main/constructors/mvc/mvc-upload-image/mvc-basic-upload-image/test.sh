#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUploadImageBasicUploadImage"
type="web"
construct=()
construct+=("mvc.yml;mvc_upload_image_basic_upload_image.php")

source "$bin/gear/module/test-module.sh"
