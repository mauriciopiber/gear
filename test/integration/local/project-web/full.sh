#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-project.sh"

# Params
project="ProjectWeb"


Gear_CreateProject "$project" "MyProjectModuleWeb;web;web.yml|MyProjectModuleCli;cli;cli.yml" $scriptDir "0" "1" "1"