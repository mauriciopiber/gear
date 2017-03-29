#!/bin/bash

testDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

suite=(
"mvc/mvc-dates"
"mvc/mvc-varchar"
)

logs="/opt/gear/gear-log.txt"

if ! [[ -d "/opt/gear" ***REMOVED******REMOVED***; then
	
	sudo mkdir /opt/gear
	sudo chmod -R 777 /opt/gear
	
fi

if ! [[ -f "/opt/gear/gear-log.txt" ***REMOVED******REMOVED***; then
	sudo touch /opt/gear/gear-log.txt
	sudo chmod -R 777 /opt/gear/gear-log.txt
fi


for i in "${suite[@***REMOVED***}"
do
   if [ -f "$testDir/constructors/$i/test.sh" ***REMOVED***; then
   	
       { time echo "Test $i found, the war will begin."; }  2>&1 |  cat >> /opt/gear/gear-log.txt
   
   fi	
   	
done








