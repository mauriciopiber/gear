#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcConstraintsBasicUnique"
type="web"
construct=()
construct+=("mvc.yml;mvc_constraints_basic_unique.php")

source "$bin/gear/module/test-module.sh"
