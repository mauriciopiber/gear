#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"


php $index gear create view $module --target=
php $index gear create test $module --suite=acceptance --target=
php $index gear create test $module --suite=functional --target=
php $index gear create test $module --suite=unit --target=