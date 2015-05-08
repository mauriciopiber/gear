#!/bin/bash
php ../../public/index.php gear unload GearAdmin
php ../../public/index.php gear unload ZfcUserDoctrineORM
../../vendor/bin/doctrine-module orm:schema-tool:update --dump-sql
php ../../public/index.php gear load GearAdmin --after=Gear
php ../../public/index.php gear load ZfcUserDoctrineORM --after=ZfcUser