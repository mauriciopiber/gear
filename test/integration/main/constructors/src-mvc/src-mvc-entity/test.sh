#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcEntity"
type="web"
construct=()
construct+=("src-mvc-entity.yml;src_mvc_entity.php")

source "$bin/gear/module/test-module.sh"
