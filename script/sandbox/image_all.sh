#!/bin/bash

# MODULE
module="SandboxImage"

# TABLE
table="AllImages"

# COLUMNS
columns="{\"varchar_upload_one\" : \"upload_image\", \"varchar_upload_two\" : \"upload_image\"}"

# MIGRATION
migration="20160123222058_image"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration
