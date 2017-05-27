
if [ "${1}" == "" ***REMOVED***; then
    testName="protractor"
else
    testName="${1}"
fi


modules=(
    "mvc/mvc-columns/mvc-varchar"
    "mvc/mvc-columns/mvc-numeric"
    "mvc/mvc-columns/mvc-text"
    "mvc/mvc-columns/mvc-dates"
)


for item in ${modules[****REMOVED***}
do
    test/integration/main/constructors/$item/test.sh reset
    test/integration/main/constructors/$item/test.sh custom 'sudo composer update'
    test/integration/main/constructors/$item/test.sh reconstruct "parallel-lint"
    test/integration/main/constructors/$item/test.sh test "$testName"

done



