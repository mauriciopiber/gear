#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcConstraints"
type="web"
construct=()
construct+=("mvc-basic-nullable/mvc.yml;mvc-basic-nullable/mvc_constraints_basic_nullable.php")
construct+=("mvc-basic-unique/mvc.yml;mvc-basic-unique/mvc_constraints_basic_unique.php")
construct+=("mvc-basic-nullable-unique/mvc.yml;mvc-basic-nullable-unique/mvc_constraints_basic_nullable_unique.php")


source "$bin/gear/module/test-module.sh"
