#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcFixture"
type="web"
build=${2}

construct=()
construct[0***REMOVED***="../src-mvc-entity/gear-entity.yml;../src-mvc-entity/20160123222001_entity_database.php"
construct[1***REMOVED***="gear-fixture.yml"

source "$bin/gear/module/test-module.sh"
