#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrUserTypes"
type="web"

construct=()
construct[0***REMOVED***="mvc-user-type-all/all.yml;mvc-user-type-all/20160123222068_user_type_all.php"
construct[1***REMOVED***="mvc-user-type-low-strict/low-strict.yml;mvc-user-type-low-strict/20160123222069_user_type_low_strict.php"
construct[2***REMOVED***="mvc-user-type-strict//strict.yml;mvc-user-type-strict/20160123222070_user_type_strict.php"


source "$bin/gear/module/test-module.sh"
