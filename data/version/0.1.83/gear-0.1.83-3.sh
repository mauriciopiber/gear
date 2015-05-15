#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=VaiTomaNoCu
php $index gear module delete $module
php $index gear module create $module


php $index gear project setUpAcl

php $index gear database mysql dump /var/www/html/modules/module/$module/data/ vai-toma-no-cu.mysql.sql


php $index gear module test create $module --suite=acceptance --target=MyCaaaAcceptanceCest.php
php $index gear module test create $module --suite=acceptance --target=MyAaaaAcceptanceCest.php
php $index gear module test create $module --suite=acceptance --target=MyBaaaAcceptanceCest.php
php $index gear module test create $module --suite=acceptance --target=MyDaaaAcceptanceCest.php


#php $index gear module test create $module --suite=functional --target=MyFirstFunctionalCest.php
#php $index gear module test create $module --suite=unit --target=MyFirstUnitTest.php


ls -l $base/module/$module/test/acceptance
echo ""
cat $base/module/$module/test/acceptance/MyFirstAcceptanceCest.php
echo ""
echo ""

php $index gear cache renew --memcached --data

php $index gear module build $module --trigger=acceptance-set --domain="ModuleMainPageCest"

exit 1

ls -l $base/module/$module/test/functional
echo ""
cat $base/module/$module/test/functional/MyFirstFunctionalCest.php
echo ""
echo ""


ls -l $base/module/$module/test/unit/TestingTest
echo ""
cat $base/module/$module/test/unit/TestingTest/MyFirstUnitTest.php
echo ""
echo ""

php $index gear module delete $module

