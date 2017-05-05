#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrControllerConsole"
type="cli"
construct=()
construct+=("controller-console.yml;")

source "$bin/gear/module/test-module.sh"
