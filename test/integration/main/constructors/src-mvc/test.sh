#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvc"
type="web"
build=${2}

construct=()
construct[0***REMOVED***="src-mvc-entity/gear-entity.yml;src-mvc-entity/20160123222001_entity_database.php"
construct[1***REMOVED***="src-mvc-fixture/gear-fixture.yml;"
construct[2***REMOVED***="src-mvc-repository/gear-repository.yml;"
construct[3***REMOVED***="src-mvc-service/gear-service.yml;"
construct[4***REMOVED***="src-mvc-filter/gear-filter.yml;"
construct[5***REMOVED***="src-mvc-form/gear-form.yml;"
construct[6***REMOVED***="src-mvc-search/gear-search.yml"

source "$bin/gear/module/test-module.sh"
