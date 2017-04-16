#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUserTypeAll"
type="web"
migration="20160123222068_user_type_all.php"
gearfile="all.yml"

source "$bin/gear/module/test-module.sh"
