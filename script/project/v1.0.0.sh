#!/bin/bash

php public/index.php gear project create CbProject --host=cb.gear.dev --git=git@bitbucket.org:mauriciopiber/cb.git --database=cb --username=root --password=gear --basepath=/var/www/gear-project/

exit 1

php public/index.php gear project upgrade [--Y***REMOVED***
gear project helper
gear project diagnostics
gear project fixture [--append***REMOVED*** [--reset-autoincrement***REMOVED***
gear project config --host= --dbname=  --username= --password= --environment= --dbms=
gear project global --host= --dbname=  --dbms= --environment=
gear project local --username= --password= 
gear project nfs
gear project virtual-host <environment>
gear project git <git>
gear project dump-autoload