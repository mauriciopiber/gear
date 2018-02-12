#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"


# Params
project="PbrProjectWeb"
modules="MyProjectModuleCli;cli;cli.yml|MyProjectModuleWeb;web;web.yml"
modulesClear="MyProjectModuleCli|MyProjectModuleWeb"

source "$bin/gear/project/test-project.sh"
    
