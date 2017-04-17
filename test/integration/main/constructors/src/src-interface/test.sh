#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcInterface"
type="cli"

construct=()
construct[1***REMOVED***="src-setup.yml;"
#construct[2***REMOVED***="src-interface.yml;"
source "$bin/gear/module/test-module.sh"
