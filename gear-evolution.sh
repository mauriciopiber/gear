### File that generate all features repeated.

basepath="/var/www/gear-package"
modulepath="basepath/gear-development"
gearpath="$basepath/gear"

cd $modulepath && vendor/bin/phinx migrate

cd $modulepath && sudo php public/index.php gear database fix YearSprint
cd $modulepath && sudo php public/index.php gear database fix MonthSprint
cd $modulepath && sudo php public/index.php gear database fix WeekSprint
cd $modulepath && sudo php public/index.php gear database fix DaySprint

cd $gearpath && sudo php public/index.php gear module db create GearDevelopment $basepath --table="YearSprint"
cd $gearpath && sudo php public/index.php gear module db create GearDevelopment $basepath --table="MonthSprint"
cd $gearpath && sudo php public/index.php gear module db create GearDevelopment $basepath --table="WeekSprint"
cd $gearpath && sudo php public/index.php gear module db create GearDevelopment $basepath --table="DaySprint"

cd $modulepath && sudo php public/index.php gear project --reset-autoincrement
cd $modulepath && sudo php public/index.php gear project setUpAcl --memcached
cd $modulepath && node_modules/.bin/gulp optimize:js:internal
