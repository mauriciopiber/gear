#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcComplete"
type="web"
construct=()
construct+=("mvc-complete-strict-unique-nullable-upload-image/mvc-complete-complete-strict-unique-nullable-upload-image.yml;mvc-complete-strict-unique-nullable-upload-image/mvc_complete_complete_strict_unique_nullable_upload_image.php")


source "$bin/gear/module/test-module.sh"
