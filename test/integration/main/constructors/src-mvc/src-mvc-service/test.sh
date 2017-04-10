#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcService"
type="web"
build=${2}

construct=()
construct[0***REMOVED***="../src-mvc-entity/gear-entity.yml;../src-mvc-entity/20160123222001_entity_database.php"
construct[1***REMOVED***="../src-mvc-fixture/gear-fixture.yml;"
construct[2***REMOVED***="../src-mvc-repository/gear-repository.yml;"
construct[3***REMOVED***="gear-service.yml;"

source "$bin/gear/module/test-module.sh"

