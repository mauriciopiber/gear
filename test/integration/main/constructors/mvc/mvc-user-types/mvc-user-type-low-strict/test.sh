#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrUserTypeLowStrict"
type="web"
migration="20160123222069_user_type_low_strict.php"
gearfile="low-strict.yml"

source "$bin/gear/module/test-module.sh"
