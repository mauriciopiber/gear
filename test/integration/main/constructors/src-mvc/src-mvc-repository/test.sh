#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcRepository"
type="web"
construct=()
construct+=("../src-mvc-entity/src-mvc-entity.yml;../src-mvc-entity/src-mvc-entity.php")
construct+=("src-mvc-repository.yml;")

source "$bin/gear/module/test-module.sh"
