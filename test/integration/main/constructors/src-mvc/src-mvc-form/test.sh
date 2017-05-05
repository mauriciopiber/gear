#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcForm"
type="web"
construct=()
construct+=("../src-mvc-filter/src-mvc-filter.yml;")
construct+=("../src-mvc-entity/src-mvc-entity.yml;../src-mvc-entity/src-mvc-entity.php")
construct+=("src-mvc-form.yml;")

source "$bin/gear/module/test-module.sh"
