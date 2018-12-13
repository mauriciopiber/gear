#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrModuleWeb"
type="web"
migration=""
gearfile="web.yml"

source "$bin/gear/module/test-module.sh"
