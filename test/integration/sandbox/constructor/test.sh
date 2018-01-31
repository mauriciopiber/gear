#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrConstructor"
type="web"
construct=()
construct+=("constructor.yml;constructor.php")

source "$bin/gear/module/test-module.sh"
