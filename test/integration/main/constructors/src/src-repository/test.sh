#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="SrcRepository"
type="cli"
construct=()
construct[1***REMOVED***="repository.yml;"
construct[2***REMOVED***="repository-namespace.yml;"
construct[3***REMOVED***="repository-dependency.yml;"

source "$bin/gear/module/test-module.sh"
