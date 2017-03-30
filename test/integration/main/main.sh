#!/bin/bash

testDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

suite=(
"constructors/mvc/mvc-dates"
"constructors/mvc/mvc-varchar"
)



for i in "${suite[@***REMOVED***}"
do
   if [ -f "$testDir/$i/test.sh" ***REMOVED***; then
   	
   	   #echo "Test $i found, the war will begin." 2>&1 | cat >> /opt/gear/gear-log.txt
       /bin/bash "$testDir/$i/test.sh" build
   
   fi	
   	
done








