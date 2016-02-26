#!/bin/bash

# MODULE
module="AllColumns"

# TABLE
table="ColumnsPousada"

# COLUMNS
columns="{\"telefone_one\" : \"telephone\", \"telefone_two\" : \"telephone\", \"url_one\" : \"url\", \"url_two\" : \"url\"}"

#

# MIGRATION
migration="20160123222058_all_pousada"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration


