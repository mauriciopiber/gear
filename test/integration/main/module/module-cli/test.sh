#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="ModuleCli"
type="cli"
migration=""
gearfile="cli.yml"

source "$bin/gear/module/test-module.sh"
