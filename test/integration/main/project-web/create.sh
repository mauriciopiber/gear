#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"


# Params
project="ProjectWeb"
modules="MyProjectModuleCli;cli;cli.yml|MyProjectModuleWeb;web;web.yml"

/bin/bash "$bin/gear/project/gear-project" "create" "$project" "$modules" "$scriptDir" "1" "0" "0"
