#!/bin/bash

# MODULE
module="Metas"

# TABLE
table="Metas"

# COLUMNS
columns="{\"prazo\" : \"datetime-pt-br\", \"valor\" : \"html\"}"

# MIGRATION
migration="20160123222054_metas"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration
