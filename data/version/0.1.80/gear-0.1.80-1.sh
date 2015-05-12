#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

php $index gear module delete FreeMind
php $index gear module create FreeMind

#php $index gear module src create FreeMind --name="Mauricio" --namespace="Piber" --yes
#php $index gear module src create FreeMind --name="Mauricio" --namespace="Fao" --yes
#php $index gear module src create FreeMind --name="Mauricio" --namespace="Buceta" --yes
php $index gear module src create FreeMind --name="Fao" --namespace="Bucetao" --yes
php $index gear module src create FreeMind --name="Mauricio" --namespace="Bucetildes" --yes --dependency="FreeMind\Bucetao\Fao"


php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql

php $index gear module build FreeMind --trigger=unit-coverage
php $index gear module build FreeMind --trigger=phpcs
php $index gear module build FreeMind --trigger=phpmd
php $index gear module build FreeMind --trigger=phpcpd
