#!/bin/bash

ssh -o "StrictHostKeyChecking no" deployer@gear-it.stag01.pibernetwork.com << EOF
    cd /var/www/staging
    sudo git clone git@bitbucket.org:mauriciopiber/gear-it.git
    cd gear-it
    sudo git pull
    sudo composer install -o
    export PHINX_ENVIRONMENT=STAGING

    sudo vendor/bin/virtualhost  /var/www/staging/gear-it gear-it.stag01.pibernetwork.com STAGING
    sudo chmod 777 -R data/DoctrineModule/cache
    sudo chmod 777 -R data/DoctrineORMModule/Proxy
    sudo chmod 777 -R data/cache/configcache
    sudo chmod 777 -R data/session
    sudo chmod 777 -R data/logs
    
    sudo vendor/bin/install-db-module gear-it.mysql.sql GearIt
    
    sudo vendor/bin/phinx migrate
EOF
