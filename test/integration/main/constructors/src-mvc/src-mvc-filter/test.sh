#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcFilter"
type="web"
construct=()
construct+=("../src-mvc-entity/src-mvc-entity.yml;../src-mvc-entity/src_mvc_entity.php")
construct+=("src-mvc-filter.yml;")

source "$bin/gear/module/test-module.sh"
