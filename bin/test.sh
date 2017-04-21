#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrColumns"
type="web"
migration="20170421014324_test.php"
gearfile="db.yml"
build=${2}

source "$bin/gear/module/test-module.sh"
