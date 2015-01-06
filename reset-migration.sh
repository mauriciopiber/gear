#!/bin/bash
#php ../../public/index.php gear unload BjyAuthorize
#php ../../public/index.php gear project resetAcl
php ../../public/index.php gear autoincrement-database
../../vendor/bin/doctrine-module data-fixture:import
#php ../../public/index.php gear project setUpAcl
#php ../../public/index.php gear load BjyAuthorize --before=ZfcBase