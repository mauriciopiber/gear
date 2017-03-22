#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="Money"
type="web"
migration="20170322101010_money.php"
gearfile="money.yml"

source "$bin/gear/module/test-module.sh"
