#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcService"
type="cli"

construct=()
construct[1***REMOVED***="src-service.yml;"
construct[2***REMOVED***="src-service-invokables.yml;"
construct[3***REMOVED***="src-service-factories.yml;"
construct[4***REMOVED***="src-service-abstract.yml;"
construct[5***REMOVED***="src-service-namespace.yml;"
construct[6***REMOVED***="src-service-extends.yml;"
construct[7***REMOVED***="src-service-dependency.yml;"
construct[8***REMOVED***="src-service-implements.yml;"


echo ${construct[****REMOVED***};

#exit 1

source "$bin/gear/module/test-module.sh"
