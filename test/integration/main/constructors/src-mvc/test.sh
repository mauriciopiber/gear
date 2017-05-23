#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvc"
type="web"
construct=()
construct+=("src-mvc-entity/src-mvc.yml;src-mvc-entity/src_mvc_entity.php")
construct+=("src-mvc-fixture/src-mvc.yml")
construct+=("src-mvc-repository/src-mvc.yml")
construct+=("src-mvc-service/src-mvc.yml")
construct+=("src-mvc-filter/src-mvc.yml")
construct+=("src-mvc-form/src-mvc.yml")
construct+=("src-mvc-search-form/src-mvc.yml")


source "$bin/gear/module/test-module.sh"
