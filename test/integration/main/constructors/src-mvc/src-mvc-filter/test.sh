#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcFilter"
type="web"
construct=()
construct+=(";")
construct+=("src-mvc-filter.yml;")

source "$bin/gear/module/test-module.sh"
