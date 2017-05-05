#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcViewHelper"
type="web"
construct=()
construct+=("src-view-helper.yml;")

source "$bin/gear/module/test-module.sh"
