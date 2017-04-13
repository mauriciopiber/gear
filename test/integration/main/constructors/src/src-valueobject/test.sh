#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcValueObject"
type="cli"
construct=()
construct[1***REMOVED***="valueobject.yml;"

source "$bin/gear/module/test-module.sh"
