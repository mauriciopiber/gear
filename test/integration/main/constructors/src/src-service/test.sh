#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcService"
type="cli"
gearfile="gear-service.yml"
build=${2}

construct=()
construct[1***REMOVED***="gear-invokables.yml;"
construct[2***REMOVED***="gear-factories.yml;"


echo ${construct[****REMOVED***};

#exit 1

source "$bin/gear/module/test-module.sh"
