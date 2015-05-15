#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=ViewTest

php $index gear module create $module

php $index gear module view create $module --target=extra/first1.phtml
php $index gear module view create $module --target=extra/first2.phtml
php $index gear module view create $module --target=extra/first3.phtml
php $index gear module view create $module --target=extra/first4.phtml
php $index gear module view create $module --target=extra/first5.phtml

ls -l $base/module/$module/view/extra

cat $base/module/$module/view/extra/first1.phtml

php $index gear module delete $module

#php $index gear create test $module --suite=acceptance --target=
#php $index gear create test $module --suite=functional --target=
#php $index gear create test $module --suite=unit --target=