#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-project.sh"

# Params
project="ProjectWeb"


deleteProject "$project"

# Create Project
createProject "$project"

# Create Cli
createModuleWeb "$project" "MyProjectModuleWeb"
constructModuleProject "$project" "MyProjectModuleWeb" "$scriptDir" "web.yml"

# Create Web
createModuleCli "$project" "MyProjectModuleCli"
constructModuleProject "$project" "MyProjectModuleCli" "$scriptDir" "cli.yml"

# Flush & Test
reload "$project"
testProject "$project"