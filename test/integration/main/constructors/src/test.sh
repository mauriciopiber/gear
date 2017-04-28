#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="Pbr"
type="web"
construct=()
construct+=("src-value-object/src-value-object.yml")


source "$bin/gear/module/test-module.sh"
