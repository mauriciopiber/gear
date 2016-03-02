#!/bin/bash


# Lest Do It

## What i need to do? start and end time of each test.


function clear_module
{
    sudo rm -R ../all-columns/config
    sudo rm -R ../all-columns/data
    sudo rm -R ../all-columns/view
    sudo rm -R ../all-columns/public
    sudo rm -R ../all-columns/test
    sudo rm -R ../all-columns/schema
    sudo rm -R ../all-columns/src  
}



/bin/bash script/module/structure/src/app.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/controller.action.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/controller.console.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/src.filter.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/src.form.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/src.repository.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/src.service.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/src.viewhelper.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/test.v1.0.0.sh
#clear_module
/bin/bash script/module/structure/src/view.v1.0.0.sh

clear_module
/bin/bash script/module/constructor/db/varchar-db.v1.0.0.sh
clear_module
/bin/bash script/module/constructor/db/date-db.v1.0.0.sh
clear_module
/bin/bash script/module/constructor/db/datetime-db.v1.0.0.sh
clear_module
/bin/bash script/module/constructor/db/decimal-db.v1.0.0.sh
clear_module
/bin/bash script/module/constructor/db/text-db.v1.0.0.sh
clear_module
/bin/bash script/module/constructor/db/time-db.v1.0.0.sh
clear_module
/bin/bash script/module/constructor/db/tinyint-db.v1.0.0.sh
clear_module
/bin/bash script/module/constructor/db/upload-image-db.v1.0.0.sh
clear_module
/bin/bash script/module/constructor/db/int-db.v1.0.0.sh