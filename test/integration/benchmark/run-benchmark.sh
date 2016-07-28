#!/bin/bash

##
## Script to run benchmark
##
## You can use on Gear:
##
## phpunit-benchmark
## phpunit
## phpunit-coverage-benchmark
## unit
## unit-coverage
## protractor
##
##
## just define the scripts to hook
##
## and wait for results
##
## Note: Should be use on branchs itself, must be modify only on Master.
##
##

if [ "$1" == "" ***REMOVED***; then

    build="phpunit-benchmark"
   
else
    build="$1"
fi

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)
RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

tests=()

#### Tests scripts ####

#tests[101***REMOVED***="test-data/medium-service-error-1"
#tests[102***REMOVED***="test-data/medium-repository-success"
#tests[103***REMOVED***="test-data/large-repository-error-2"
#tests[104***REMOVED***="test-data/force/large-repository-error-2"

tests[1***REMOVED***="constructor-singular/constructor-singular-repository/forward"
tests[2***REMOVED***="constructor-singular/constructor-singular-service/forward"
tests[3***REMOVED***="constructor-singular/constructor-singular-controller/forward"
tests[4***REMOVED***="constructor-singular/constructor-singular-suite/forward"

#tests[5***REMOVED***="constructor-db-small/constructor-db-small-repository/forward"
#tests[6***REMOVED***="constructor-db-small/constructor-db-small-service/forward"
#tests[7***REMOVED***="constructor-db-small/constructor-db-small-controller/forward"
#tests[8***REMOVED***="constructor-db-small/constructor-db-small-suite/forward"

#tests[9***REMOVED***="constructor-db-medium/constructor-db-medium-repository/forward"
#tests[10***REMOVED***="constructor-db-medium/constructor-db-medium-service/forward"
#tests[11***REMOVED***="constructor-db-medium/constructor-db-medium-controller/forward"
#tests[12***REMOVED***="constructor-db-medium/constructor-db-medium-suite/forward"



DATE=`date +%Y%m%d%H%M%S`

log="benchmark-$DATE"

logDir=$fullpath/benchmark-logs/$log

mkdir $logDir
touch $logDir/benchmark.log

echo "Running Gear Benchmark, act responsable! by Mauricio Piber"
echo ""
echo ""

if [ "${2}" == "module" ***REMOVED***; then

echo "--- Installing Module"
/bin/bash $fullpath/start_module.sh
echo "--- Module Installed"
echo "--- Starting running Benchmark"

fi 

ALLSTART=$(date +%s)

for testName in "${tests[@***REMOVED***}"
do
    
    START=$(date +%s)

    echo ""
    echo "--- Executing script $testName"

    test=$(/bin/bash $fullpath/$testName.sh $build)
    
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
    END=$(date +%s)
    DIFF=$(( $END - $START ))
    
    output="$testName: $result on $DIFF"
        
    echo "--- Benckmark Result ending."
    echo "----- Test result $output"
    echo $output >> $logDir/benchmark.log
    echo "--------------------------------------------------------"
   
done

ALLEND=$(date +%s)
ALLDIFF=$(( $ALLEND - $ALLSTART ))
echo "It took $ALLDIFF seconds"
   
echo "--- Ending Benchmark."
echo ""
echo ""

exit 1
