#!/bin/bash

# MODULE
module="AllColumns"

# TABLE
table="AllColumnsNames"

# COLUMNS
columns="{}"

#{\"varchar_upload_one\" : \"upload_image\", \"varchar_upload_two\" : \"upload_image\"}

# MIGRATION
migration="20160123222058_all_columns"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration
