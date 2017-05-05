#!/bin/bash

testDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

suite=(
"constructors/src"
"constructors/src-mvc"
"constructors/controller-mvc"
"constructors/controller/controller-console"
"constructors/controller/controller-web"
"constructors/mvc/mvc-columns"
"constructors/mvc/mvc-constraints"
"constructors/mvc/mvc-usertype"
"constructors/mvc/mvc-complete"
"constructors/mvc/mvc-upload-image"
"constructors/mvc/mvc-controller"
)




for i in "${suite[@***REMOVED***}"
do
   if [ -f "$testDir/$i/test.sh" ***REMOVED***; then
   	
   	   #echo "Test $i found, the war will begin." 2>&1 | cat >> /opt/gear/gear-log.txt
       /bin/bash "$testDir/$i/test.sh" build
   
   fi	
   	
done








