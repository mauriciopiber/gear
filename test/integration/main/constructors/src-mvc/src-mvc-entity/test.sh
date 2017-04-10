#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcEntity"
type="web"
migration="20160123222001_entity_database.php"
gearfile="gear-entity.yml"
build=${2}

source "$bin/gear/module/test-module.sh"
