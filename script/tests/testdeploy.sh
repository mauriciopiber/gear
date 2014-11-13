#!/bin/bash
php ./../../public/index.php gear project deploy development
cat ./../../config/autoload/global.php
cat ./../../config/autoload/local.php
cat ./../../public/.htaccess
php ./../../public/index.php gear project deploy staging
cat ./../../config/autoload/global.php
cat ./../../config/autoload/local.php
cat ./../../public/.htaccess
php ./../../public/index.php gear project deploy production
cat ./../../config/autoload/global.php
cat ./../../config/autoload/local.php
cat ./../../public/.htaccess
php ./../../public/index.php gear project deploy testing-stag
cat ./../../config/autoload/global.php
cat ./../../config/autoload/local.php
cat ./../../public/.htaccess
php ./../../public/index.php gear project deploy testing-dev
cat ./../../config/autoload/global.php
cat ./../../config/autoload/local.php
cat ./../../public/.htaccess
