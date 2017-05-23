#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumnsText"
type="web"
construct=()
construct+=("mvc-columns-text.yml;mvc_columns_text.php")

source "$bin/gear/module/test-module.sh"
