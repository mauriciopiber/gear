# MODULE
module=${1}

# TABLE
table=${2}

# COLUMNS
columns=${3}

# MIGRATION
migration=${4}

moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
baseGear="/var/www/gear-package/gear"
basePath="/var/www/gear-package"
modulePath="$basePath/$moduleUrl"

#/bin/bash script/install_module_create.sh $baseGear $basePath $modulePath $module $moduleUrl


/bin/bash script/install_module_db.sh $baseGear $basePath $modulePath $module $moduleUrl $table "$columns" $migration
