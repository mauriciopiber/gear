#!/bin/bash
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../bin && pwd )"

# Params
project="ProjectWeb"
modules="MyProjectModuleWeb;web;web.yml|MyProjectModuleCli;cli;cli.yml"

/bin/bash "$bin/gear/project/gear-project" "create" "$project" "$modules" "$scriptDir"  "0" "1" "0"