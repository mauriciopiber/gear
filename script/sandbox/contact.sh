#!/bin/bash

#!/bin/bash

# MODULE
module="SandboxContact"

# TABLE
table="Contato"

# COLUMNS
columns="{\"email\" : \"email\", \"mensagem\" : \"html\"}"

# MIGRATION
migration="20160123222054_contact"


### INSTALLER
/bin/bash script/install_module.sh $module $table "$columns" $migration