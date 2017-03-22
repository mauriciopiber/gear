#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../_functions && pwd )"

source "$headersDir/abstract-web.sh"

removeModule "ControllerWeb"

constructModuleWeb "ControllerWeb"

runConstructWeb "ControllerWeb" "$scriptDir/simpliest-controller.yml"

