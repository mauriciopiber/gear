#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

php $index gear module delete FreeMind
php $index gear module create FreeMind

#php $index gear module src create FreeMind --name="Mauricio" --namespace="Piber" --yes
#php $index gear module src create FreeMind --name="Mauricio" --namespace="Fao" --yes
#php $index gear module src create FreeMind --name="Mauricio" --namespace="Buceta" --yes
php $index gear module src create FreeMind --name="Tenis" --namespace="Catalog" --yes
php $index gear module src create FreeMind --name="Cadarco" --namespace="Catalog" --yes
php $index gear module src create FreeMind --name="Novato" --namespace="Catalog" --yes
php $index gear module src create FreeMind --name="Standard" --namespace="Catalog" --yes

php $index gear module src create FreeMind --name="Complexo" --namespace="Terno" --yes --dependency="FreeMind\Catalog\Tenis,FreeMind\Catalog\Cadarco,FreeMind\Catalog\Novato,FreeMind\Catalog\Standard"




php $index gear database mysql dump /var/www/html/modules/module/FreeMind/data/ free-mind.mysql.sql

php $index gear module build FreeMind --trigger=unit-coverage
php $index gear module build FreeMind --trigger=phpcs
php $index gear module build FreeMind --trigger=phpmd
php $index gear module build FreeMind --trigger=phpcpd
