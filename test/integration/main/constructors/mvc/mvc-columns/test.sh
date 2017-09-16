#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumns"
type="web"
construct=()
#construct+=("mvc-complete/mvc-complete.yml;mvc-complete/mvc_complete.php")
construct+=("mvc-basic/mvc-basic.yml;mvc-basic/mvc_basic.php")
construct+=("mvc-varchar/mvc-varchar.yml;mvc-varchar/mvc_varchar.php")
construct+=("mvc-dates/mvc-dates.yml;mvc-dates/mvc_dates.php")
construct+=("mvc-text/mvc-text.yml;mvc-text/mvc_text.php")
construct+=("mvc-numeric/mvc-numeric.yml;mvc-numeric/mvc_numeric.php")


source "$bin/gear/module/test-module.sh"
