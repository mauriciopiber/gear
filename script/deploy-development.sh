#!/bin/bash

ls -l vendor/autoload.php &> /dev/null

if [ "$?" != "0" ***REMOVED***; then
    composer update
fi;

php public/index.php gear module dump-autoload Gear
