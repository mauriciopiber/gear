#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcService"
type="web"
construct=()
construct+=("src-mvc-service.yml;")

source "$bin/gear/module/test-module.sh"
