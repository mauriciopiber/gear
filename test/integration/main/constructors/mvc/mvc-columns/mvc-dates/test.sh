#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumnsDates"
type="web"
construct=()
construct+=("mvc-dates.yml;mvc_columns_dates.php")

source "$bin/gear/module/test-module.sh"
