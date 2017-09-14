#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUploadImage"
type="web"
construct=()
construct+=("mvc-basic-upload-image/mvc-basic-upload-image.yml;mvc-basic-upload-image/mvc_basic_upload_image.php")


source "$bin/gear/module/test-module.sh"
