
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-strict/test.sh reset
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-strict/test.sh reconstruct "parallel-lint"
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-strict/test.sh test "${1}"

test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-low-strict/test.sh reset
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-low-strict/test.sh reconstruct "parallel-lint"
test/integration/main/constructors/mvc/mvc-usertypes/mvc-basic-low-strict/test.sh test "${1}"

