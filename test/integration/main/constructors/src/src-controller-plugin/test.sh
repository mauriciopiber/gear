#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcControllerPlugin"
type="cli"
construct=()
construct[1***REMOVED***="src-controller-plugin.yml;"

source "$bin/gear/module/test-module.sh"
