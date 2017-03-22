#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="SrcEntity"
type="cli"
migration="20160123222067_all_columns_db.php"
gearfile="gear-entity.yml"

source "$bin/gear/module/test-module.sh"
