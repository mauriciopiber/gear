#!/bin/bash

# HEADER

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-web.sh"

runConstruct "ModuleWeb" "web" "$scriptDir/web.yml" ""
