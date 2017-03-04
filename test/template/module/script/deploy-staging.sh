#!/bin/bash

ssh deployer@gear-it.stag01.pibernetwork.com << EOF
    cd /var/www/staging/gear-it
    sudo git pull
    sudo composer install -o
    export PHINX_ENVIRONMENT=STAGING
    sudo vendor/bin/phinx migrate
EOF
