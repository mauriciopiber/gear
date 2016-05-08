#!/bin/bash

vendor/bin/phinx rollback
vendor/bin/phinx migrate
vendor/bin/phinx seed:run
php public/index.php gear database fix table IntDepThree --no-truncate
