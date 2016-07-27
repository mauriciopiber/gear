#!/bin/bash
export APP_ENV=development
php public/index.php gear config --host="http://qgmoveis.pibernetwork.com.br" --database="stag-qgmoveis" --username="root" --password="gear" --environment="staging" --dbms="mysql"
php public/index.php gear mysql --from-schema --database="stag-qgmoveis" --username="root" --password="gear"
php public/index.php gear environment  staging
export APP_ENV=staging
php public/index.php gear acl
php public/index.php gear load BjyAuthorize

#sistema funcionando corretamente, com usuário padrão admin@pibernetwork.com.br
#funções esperadas: registar pelo console e acessar http normalmente.