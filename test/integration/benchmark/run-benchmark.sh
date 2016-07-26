#!/bin/bash

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)
RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

tests=()

#tests[0***REMOVED***="constructor-db-small/constructor-db-small-repository/forward.sh"
#tests[1***REMOVED***="constructor-db-small/constructor-db-small-service/forward.sh"
#tests[2***REMOVED***="constructor-db-small/constructor-db-small-controller/forward.sh"
#tests[3***REMOVED***="constructor-db-small/constructor-db-small-suite/forward.sh"

#tests[4***REMOVED***="constructor-db-medium/constructor-db-medium-repository/forward.sh"
#tests[5***REMOVED***="constructor-db-medium/constructor-db-medium-service/forward.sh"
#tests[6***REMOVED***="constructor-db-medium/constructor-db-medium-controller/forward.sh"
#tests[7***REMOVED***="constructor-db-medium/constructor-db-medium-suite/forward.sh"

tests[8***REMOVED***="constructor-singular/constructor-singular-repository/forward.sh"
tests[9***REMOVED***="constructor-singular/constructor-singular-service/forward.sh"
tests[10***REMOVED***="constructor-singular/constructor-singular-controller/forward.sh"
tests[11***REMOVED***="constructor-singular/constructor-singular-suite/forward.sh"

DATE=`date +%Y%m%d%H%M%S`

log="benchmark-$DATE"

logDir=$fullpath/benchmark-logs/$log

mkdir $logDir

echo "Running Gear Benchmark, act responsable! by Mauricio Piber"
echo ""
echo ""


echo "--- Installing Module"

/bin/bash $fullpath/start_module.sh

echo "--- Module Installed"

echo "--- Starting running Benchmark"

ALLSTART=$(date +%s)

for testName in "${tests[@***REMOVED***}"
do
    START=$(date +%s)

    echo ""
    echo "--- Executing script $testName"

    test=$(/bin/bash $fullpath/$testName)
    
    echo "--- Script ended execution"
    
    logBaseDir=$(dirname "$logDir/$testName")
    
    ls -l $logBaseDir &> /dev/null
    
    if [ "$?" != "0" ***REMOVED***; then
        mkdir -p $logBaseDir
    fi;
    
    echo "$test" >> "$logDir/$testName"
    
    echo "--- Benchmark Result."
    
    line=$(echo $test | sed -n 's/.*\(FAILURES!\).*/\1/p')
    
    length=${#line}
    
    if [ $length != 0 ***REMOVED***; then
        printf "${RED} $line on unit tests, fix it ${NC}\n"
    fi
    
    line=$(echo $test | sed -n 's/.*\(PHP Parse error\).*/\1/p')
    
    length=${#line}
    
    if [ $length != 0 ***REMOVED***; then
        printf "${RED} $line on unit tests, fix it now! ${NC}\n"
        continue
    fi    
    
    line=$(echo $test | sed -n 's/.*\(OK\).*/\1/p')
    
    length=${#line}
    
    if [ $length != 0 ***REMOVED***; then
        printf "${GREEN} $line on unit tests, go ahead ${NC}\n"
    fi    
    
    result=$(echo $test | sed -n 's/.*\(Time: [0-9***REMOVED****\.[0-9***REMOVED**** [secondsminutes***REMOVED****, Memory: [0-9***REMOVED****\.[0-9***REMOVED****MB\).*/\1/p')
    echo "----- Test result $testName: $result"    
    END=$(date +%s)
    DIFF=$(( $END - $START ))
    echo "----- It took $DIFF seconds"
    echo "--- Benckmark Result ending."
    echo "----------------------------"
   
done

ALLEND=$(date +%s)
ALLDIFF=$(( $ALLEND - $ALLSTART ))
echo "It took $ALLDIFF seconds"
   
echo "--- Ending Benchmark."
echo ""
echo ""

exit 1
