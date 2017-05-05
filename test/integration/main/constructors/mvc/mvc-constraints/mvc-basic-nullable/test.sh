#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcBasicNullable"
type="web"
construct=()
construct+=("mvc-basic-nullable.yml;mvc_basic_nullable.php")

source "$bin/gear/module/test-module.sh"
