#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"


php $index gear create controller $module --target=
php $index gear create activity $module --suite=acceptance --target=
