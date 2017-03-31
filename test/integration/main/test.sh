#!/bin/bash

testDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"



/bin/bash $testDir/constructors/src/src-db-usertype-all/test.sh "test" 'unit-namespace -DtestNamespace="PbxSrcDbAllTest/SrcMvcTest/ServiceTest"'
/bin/bash $testDir/constructors/src/src-db-usertype-low-strict/test.sh "test" 'unit-namespace -DtestNamespace="PbxSrcDbLowStrictTest/SrcMvcTest/ServiceTest"'
/bin/bash $testDir/constructors/src/src-db-usertype-strict/test.sh "test" 'unit-namespace -DtestNamespace="PbxSrcDbStrictTest/SrcMvcTest/ServiceTest"'