#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcRepository"
type="cli"
construct=()
#construct[1***REMOVED***="repository.yml;"
#construct[2***REMOVED***="repository-namespace.yml;"
construct[0***REMOVED***="../src-interface/gear-interface.yml;"
construct[1***REMOVED***="repository-implement.yml;"

source "$bin/gear/module/test-module.sh"
