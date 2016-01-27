#!/bin/bash

# MODULE
module="SandboxDate"

# TABLE
table="AllDates"

# COLUMNS
columns="{\"date_ptbr\" : \"date_pt_br\", \"datetime_ptbr\" : \"datetime_pt_br\"}"

# MIGRATION
migration="20160123222056_date"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration
