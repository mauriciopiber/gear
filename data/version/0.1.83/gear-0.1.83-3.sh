#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=VaiTomaNoCu
php $index gear module delete $module
php $index gear module create $module

php $index gear project setUpAcl
php $index gear database mysql dump /var/www/html/modules/module/$module/data/ vai-toma-no-cu.mysql.sql
php $index gear cache renew --memcached --data


#php $index gear module test create $module --suite=acceptance --target=MyAaaaAcceptanceCest.php
#php $index gear module test create $module --suite=acceptance --target=MyBaaaAcceptanceCest.php
#php $index gear module test create $module --suite=acceptance --target=MyCaaaAcceptanceCest.php
#php $index gear module test create $module --suite=acceptance --target=MyDaaaAcceptanceCest.php
#php $index gear module build $module --trigger=acceptance

#php $index gear module test create $module --suite=functional --target=MyAaaaFunctionalCest.php
#php $index gear module test create $module --suite=functional --target=MyBaaaFunctionalCest.php
#php $index gear module test create $module --suite=functional --target=MyCaaaFunctionalCest.php
#php $index gear module test create $module --suite=functional --target=MyDaaaFunctionalCest.php
#php $index gear module build $module --trigger=functional


php $index gear module test create $module --suite=unit --target=MyTest/MyAaaaUnitTest.php
php $index gear module test create $module --suite=unit --target=MySecond/MyBaaaUnitTest.php
php $index gear module test create $module --suite=unit --target=MyCaaaUnitTest.php
php $index gear module test create $module --suite=unit --target=MyDaaaUnitTest.php
ls -l $base/module/$module/test/unit
ls -l $base/module/$module/test/unit/TestingTest

php $index gear module build $module --trigger=unit

exit 1


ls -l $base/module/$module/test/unit/TestingTest
echo ""
cat $base/module/$module/test/unit/TestingTest/MyFirstUnitTest.php
echo ""
echo ""

php $index gear module delete $module

