#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBasicNullableUnique"
type="web"
construct=()
construct+=("mvc-basic-nullable-unique.yml;mvc_basic_nullable_unique.php")

source "$bin/gear/module/test-module.sh"
