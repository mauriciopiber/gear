#!/bin/bash

# MODULE
module="SandboxImageUpload"

# TABLE
table="AllImagesUpload"

# COLUMNS
columns="{\"varchar_upload_one\" : \"upload-image\", \"varchar_upload_two\" : \"upload-image\"}"

# MIGRATION
migration="20160123222060_image_upload"

### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration
