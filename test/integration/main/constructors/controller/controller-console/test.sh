#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="ControllerConsole"
type="cli"
migration=""
gearfile="console.yml"

source "$bin/gear/module/test-module.sh"
