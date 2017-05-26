
if [ "${1}" == "" ***REMOVED***; then
	
	testName="protractor"
else 
    testName="${1}"	
fi

	
	

#test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-strict/test.sh reset
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-strict/test.sh reconstruct "parallel-lint"
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-strict/test.sh test "$testName"

#test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-low-strict/test.sh reset
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-low-strict/test.sh reconstruct "parallel-lint"
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-low-strict/test.sh test "$testName"

