#!/usr/bin/env bash

php public/index.php gear schema delete my-api-module /var/www/gear-package
php public/index.php gear schema create my-api-module /var/www/gear-package
php public/index.php gear module src create my-api-module /var/www/gear-package --name=MyService --type=Service
