#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbxSrcService"
type="web"
migration="20160123222068_src_db.php"
gearfile="gear-service.yml"
build=${2}

source "$bin/gear/module/test-module.sh"
