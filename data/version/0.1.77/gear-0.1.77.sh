#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

#preparando projeto

params="--host=development.gear.dev --git=git@bitbucket.org:mauriciopiber/gear-development.git --nfs --database=\"gear_development\" --username=root --password=gear"
php $index gear project create Development $params
