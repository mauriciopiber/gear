#!/bin/bash

CMD=${1}
MODULE=${2}
TYPE=${3}
JUST=${4}

[ "$JUST" != "" ***REMOVED*** && JUST="--just=${JUST}"
echo "${CMD} ${MODULE} ${TYPE} $JUST"

if ! [ -f /var/www/local/$MODULE/composer.json ***REMOVED***
then
    echo "You probably forgot to specify /var/www/local volume or module doesn't exist"
    exit 5
fi
php /var/www/module/public/index.php gear module $CMD $MODULE --type=$TYPE /var/www/local $JUST --force
