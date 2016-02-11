#!/bin/bash

# MODULE
module="AllColumns"

# TABLE
table="AllColumnsNames"

# COLUMNS
columns="{\"varchar_upload_one\" : \"upload-image\", \"varchar_upload_two\" : \"upload-image\", \"email_mensagem\" : \"email\", \"mensagem_da_mensagem\" : \"html\"}"

#

# MIGRATION
migration="20160123222058_all_columns"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration

cat /var/www/gear-package/all-columns/config/ext/route.config.php
cat /var/www/gear-package/all-columns/config/ext/navigation.config.php
