#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrUploadImageAll"
type="web"
construct=()
construct+=("image.yml;image.php")

source "$bin/gear/module/test-module.sh"
