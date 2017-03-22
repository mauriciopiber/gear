#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="Evolution"
type="web"
migration="20170322101011_evolution.php"
gearfile="evolution.yml"

source "$bin/gear/module/test-module.sh"
