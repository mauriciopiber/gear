#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcUploadImage"
type="web"
migration="20160123222067_all_columns_db.php"
gearfile="db.yml"

source "$bin/gear/module/test-module.sh"
