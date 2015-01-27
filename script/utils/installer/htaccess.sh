#!/bin/bash
environment=${1}



echo "RewriteEngine On
SetEnv APP_ENV $environment
RewriteCond %{REQUEST_FILENAME} -s [OR***REMOVED***
RewriteCond %{REQUEST_FILENAME} -l [OR***REMOVED***
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^.*$ - [NC,L***REMOVED***
RewriteCond %{REQUEST_URI}::\$1 ^(/.+)(.+)::\2$
RewriteRule ^(.*) - [E=BASE:%1***REMOVED***
RewriteRule ^(.*)$ %{ENV:BASE}index.php [NC,L***REMOVED***" > ${2}/public/.htaccess

#echo "Exportado e incluido com sucesso"
