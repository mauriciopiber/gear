#!/usr/bin/env bash

php public/index.php gear schema delete my-api-module /var/www/gear-package
php public/index.php gear schema create my-api-module /var/www/gear-package
php public/index.php gear module controller create my-api-module /var/www/gear-package --name=MyController --type=Rest
php public/index.php gear schema dump my-api-module /var/www/gear-package
