#!/bin/bash

testDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

suite=(
#"constructors/mvc/mvc-dates"
#"constructors/mvc/mvc-varchar"
"constructors/mvc/mvc-usertype-all"
"constructors/mvc/mvc-usertype-low-strict"
"constructors/mvc/mvc-usertype-strict"
"constructors/mvc/mvc-usertypes"
)



for i in "${suite[@***REMOVED***}"
do
   if [ -f "$testDir/$i/test.sh" ***REMOVED***; then
   	
   	   #echo "Test $i found, the war will begin." 2>&1 | cat >> /opt/gear/gear-log.txt
       /bin/bash "$testDir/$i/test.sh" build
   
   fi	
   	
done








