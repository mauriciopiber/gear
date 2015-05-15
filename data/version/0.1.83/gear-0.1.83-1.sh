#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

#cat $base/codeception.yml
#php $index gear module create CodeceptionOne
#cat $base/codeception.yml
#php $index gear module delete CodeceptionOne
#cat $base/codeception.yml


php $index gear module create CodeceptionOne
php $index gear module create CodeceptionTwo
php $index gear module create CodeceptionThree
cat $base/codeception.yml
php $index gear module delete CodeceptionOne
php $index gear module delete CodeceptionTwo
php $index gear module delete CodeceptionThree
cat $base/codeception.yml

exit 1