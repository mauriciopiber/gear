#!/bin/bash

testDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

suite=(
"constructors/src"
"constructors/controller/controller-console"
"constructors/controller/controller-web"
"constructors/mvc/mvc-columns/mvc-basic"
"constructors/mvc/mvc-columns/mvc-complete"
"constructors/mvc/mvc-columns/mvc-dates"
"constructors/mvc/mvc-columns/mvc-numeric"
"constructors/mvc/mvc-columns/mvc-text"
"constructors/mvc/mvc-columns/mvc-varchar"
"constructors/mvc/mvc-constraints/mvc-basic-unique"
"constructors/mvc/mvc-constraints/mvc-basic-nullable"
"constructors/mvc/mvc-constraints/mvc-basic-nullable-unique"
"constructors/mvc/mvc-usertype/mvc-basic-strict"
"constructors/mvc/mvc-usertype/mvc-basic-low-strict"
"constructors/mvc/mvc-complete/mvc-complete-strict-unique-nullable-upload-image"
"constructors/mvc/mvc-upload-image/mvc-basic-upload-image"
"constructors/mvc/mvc-controller"
)




for i in "${suite[@***REMOVED***}"
do
   if [ -f "$testDir/$i/test.sh" ***REMOVED***; then
       
          #echo "Test $i found, the war will begin." 2>&1 | cat >> /opt/gear/gear-log.txt
       /bin/bash "$testDir/$i/test.sh" build
   
   fi    
       
done








