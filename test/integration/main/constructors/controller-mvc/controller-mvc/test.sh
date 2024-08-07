#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrControllerMvc"
type="web"
construct=()
construct+=("../../src-mvc/src-mvc-entity/src-mvc-entity.yml;../../src-mvc/src-mvc-entity/src_mvc_entity.php")
construct+=("../../src-mvc/src-mvc-fixture/src-mvc-fixture.yml;")
construct+=("../../src-mvc/src-mvc-repository/src-mvc-repository.yml;")
construct+=("../../src-mvc/src-mvc-service/src-mvc-service.yml;")
construct+=("../../src-mvc/src-mvc-filter/src-mvc-filter.yml;")
construct+=("../../src-mvc/src-mvc-form/src-mvc-form.yml;")
construct+=("../../src-mvc/src-mvc-search-form/src-mvc-search-form.yml;")
construct+=("controller-mvc.yml;")

source "$bin/gear/module/test-module.sh"
