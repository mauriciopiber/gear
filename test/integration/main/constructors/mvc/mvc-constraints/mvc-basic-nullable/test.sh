#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcConstraintsBasicNullable"
type="web"
construct=()
construct+=("mvc-constraints-basic-nullable.yml;mvc_constraints_basic_nullable.php")

source "$bin/gear/module/test-module.sh"
