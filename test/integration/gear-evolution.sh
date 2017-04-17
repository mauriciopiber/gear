### File that generate all features repeated.

basepath="/var/www/gear-package"
modulepath="$basepath/gear-evolution"
gearpath="$basepath/gear"


mysql -uroot -pgear -e "drop database gear_evolution"
mysql -uroot -pgear -e "create database gear_evolution"
cd $modulepath && vendor/bin/phinx migrate

cd $modulepath && vendor/bin/unload-module BjyAuthorize


cd $modulepath && sudo php public/index.php gear database fix table YearSprint
cd $modulepath && sudo php public/index.php gear database fix table MonthSprint
cd $modulepath && sudo php public/index.php gear database fix table WeekSprint
cd $modulepath && sudo php public/index.php gear database fix table DaySprint

cd $modulepath && sudo php public/index.php gear schema db delete GearEvolution $basepath YearSprint
cd $modulepath && sudo php public/index.php gear schema db delete GearEvolution $basepath MonthSprint
cd $modulepath && sudo php public/index.php gear schema db delete GearEvolution $basepath WeekSprint
cd $modulepath && sudo php public/index.php gear schema db delete GearEvolution $basepath DaySprint

cd $modulepath && sudo php public/index.php gear module db create GearEvolution $basepath --table="YearSprint"
cd $modulepath && sudo php public/index.php gear module db create GearEvolution $basepath --table="MonthSprint"
cd $modulepath && sudo php public/index.php gear module db create GearEvolution $basepath --table="WeekSprint"
cd $modulepath && sudo php public/index.php gear module db create GearEvolution $basepath --table="DaySprint"


cd $modulepath && sudo php public/index.php gear project fixture --reset-autoincrement
cd $modulepath && sudo php public/index.php gear project setUpAcl --memcached
cd $modulepath && node_modules/.bin/gulp optimize:js:internal

cd $modulepath && sudo php public/index.php gear module load BjyAuthorize --after=ZfcUserDoctrineORM

cd $modulepath && sudo php public/index.php gear database module dump GearEvolution

cd $modulepath && ant
