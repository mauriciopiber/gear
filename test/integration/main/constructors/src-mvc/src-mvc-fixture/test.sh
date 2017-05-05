#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcFixture"
type="web"
construct=()
construct+=("src-mvc-fixture.yml;")

source "$bin/gear/module/test-module.sh"
