#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcCompleteCompleteStrictUniqueNullableUploadImage"
type="web"
construct=()
construct+=("mvc-complete-complete-strict-unique-nullable-upload-image.yml;mvc_complete_complete_strict_unique_nullable_upload_image.php")

source "$bin/gear/module/test-module.sh"
