#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrMvcColumns"
type="web"
construct=()
construct+=("mvc-complete/mvc-cmp.yml;mvc-complete/mvc_cmp.php")
construct+=("mvc-basic/mvc-bsc.yml;mvc-basic/mvc_bsc.php")
construct+=("mvc-varchar/mvc-vrc.yml;mvc-varchar/mvc_vrc.php")
construct+=("mvc-dates/mvc-dts.yml;mvc-dates/mvc_dts.php")
construct+=("mvc-text/mvc-txt.yml;mvc-text/mvc_txt.php")
construct+=("mvc-numeric/mvc-nmr.yml;mvc-numeric/mvc_nmr.php")


source "$bin/gear/module/test-module.sh"
