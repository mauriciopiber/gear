#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="Pbr\Module\SrcZf2"
type="src-zf2"
migration=""
gearfile="src-zf2.yml"

source "$bin/gear/module/test-module.sh"
