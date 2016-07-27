#!/bin/bash
export APP_ENV=development
php public/index.php gear config --host="http://qgmoveis.com.br" --database="qgmoveis" --username="qgmoveis" --password="qgm0v31s" --environment="production" --dbms="mysql"
php public/index.php gear mysql --from-schema --database="stag-qgmoveis" --username="root" --password="gear"
php public/index.php gear environment  staging
export APP_ENV=staging
php public/index.php gear acl
php public/index.php gear load BjyAuthorize