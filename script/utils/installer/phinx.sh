#!/bin/bash
projectDir=${1}
database=${2}
username=${3}
password=${4}

cd $projectDir

echo "
paths:
    migrations: %%PHINX_CONFIG_DIR%%/migrations

environments:
    default_migration_table: migrations
    default_database: development
    development:
        adapter: mysql
        host: localhost
        name: $database
        user: $username
        pass: $password
        port: 3306
        charset: utf8
" > ./phinx.yml