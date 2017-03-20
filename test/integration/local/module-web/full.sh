#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-cli.sh"

module="ModuleWeb"

runCreateModule "$module" "web" "$scriptDir/web.yml" "" "0" "1"