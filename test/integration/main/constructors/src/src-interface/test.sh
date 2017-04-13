#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcInterface"
type="cli"
migration=""
gearfile="gear-interface.yml"
build=${2}

source "$bin/gear/module/test-module.sh"