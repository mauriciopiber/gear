#!/bin/bash

# MODULE
module="SandboxImageVarchar"

# TABLE
table="AllImagesVarchar"

# COLUMNS
columns="{\"varchar_upload_one\" : \"upload_image\", \"varchar_upload_two\" : \"upload_image\"}"

# MIGRATION
migration="20160123222060_image_varchar_upload"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration
