#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd DIR && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module=""
type="TYPE"
construct=()
construct+=("")

source "$bin/gear/module/test-module.sh"
