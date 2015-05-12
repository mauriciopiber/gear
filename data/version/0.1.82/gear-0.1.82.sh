#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

php $index gear module delete FreeMind
php $index gear module create FreeMind

php $index gear module src create FreeMind --type="Service" --name="MyService"
php $index gear module src create FreeMind --type="Repository" --name="MyRepository"
php $index gear module src create FreeMind --type="Form" --name="MyRepository"
php $index gear module src create FreeMind --type="Filter" --name="MyFilter"


php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql

php $index gear module build FreeMind --trigger=unit-coverage
php $index gear module build FreeMind --trigger=phpcs
php $index gear module build FreeMind --trigger=phpmd
php $index gear module build FreeMind --trigger=phpcpd


