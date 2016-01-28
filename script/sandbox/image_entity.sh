#!/bin/bash

# MODULE
module="SandboxImageEntities"

# TABLE
table="AllImagesEntities"

# MIGRATION
migration="20160123222060_image_entity"

### INSTALLER
/bin/bash script/install_module.sh $module $table "{}" $migration
