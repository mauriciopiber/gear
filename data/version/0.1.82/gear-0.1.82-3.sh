#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

php $index gear module unload BjyAuthorize

php $index gear module delete FreeMind
php $index gear module create FreeMind


