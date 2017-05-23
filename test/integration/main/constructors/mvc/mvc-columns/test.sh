#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumns"
type="web"
construct=()
construct+=("mvc-complete/mvc-complete.yml;mvc-complete/mvc_columns_complete.php")
construct+=("mvc-basic/mvc-basic.yml;mvc-basic/mvc_columns_basic.php")
construct+=("mvc-varchar/mvc-varchar.yml;mvc-varchar/mvc_columns_varchar.php")
construct+=("mvc-dates/mvc-dates.yml;mvc-dates/mvc_columns_dates.php")
construct+=("mvc-text/mvc-text.yml;mvc-text/mvc_columns_text.php")
construct+=("mvc-numeric/mvc-numeric.yml;mvc-numeric/mvc_columns_numeric.php")


source "$bin/gear/module/test-module.sh"
