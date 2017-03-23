#!/bin/bash
# ABSTRACT MODULE
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"

function Gear_Help 
{ 
    type=${1}
    command=${2}
    cat "$headerDir/../docs/$type/$command.md"
}

