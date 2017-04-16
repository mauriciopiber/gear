#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrUserTypeStrict"
type="web"
migration="20160123222070_user_type_strict.php"
gearfile="strict.yml"

source "$bin/gear/module/test-module.sh"
