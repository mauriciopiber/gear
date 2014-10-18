#!/bin/bash

environment=${1}

cd ${2}

echo "RewriteEngine On
SetEnv APP_ENV $environment
RewriteCond %{REQUEST_FILENAME} -s [OR***REMOVED***
RewriteCond %{REQUEST_FILENAME} -l [OR***REMOVED***
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^.*$ - [NC,L***REMOVED***
RewriteCond %{REQUEST_URI}::\$1 ^(/.+)(.+)::\2$
RewriteRule ^(.*) - [E=BASE:%1***REMOVED***
RewriteRule ^(.*)$ %{ENV:BASE}index.php [NC,L***REMOVED***" > ./public/.htaccess
