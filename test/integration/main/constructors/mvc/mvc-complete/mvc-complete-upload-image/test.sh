#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcCompleteUploadImage"
type="web"
construct=()
construct+=("mvc-complete-upload-image.yml;mvc_complete_upload_image.php")

source "$bin/gear/module/test-module.sh"
