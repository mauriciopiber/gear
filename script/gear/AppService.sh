#!/bin/bash

#php public/index.php gear module src create Gear /var/www/gear-package --name="AppServiceSpecService" --type="Service" --extends="Mvc\\AbstractMvcTest" --namespace="Mvc\\View\\App"
#php public/index.php gear module src create Gear /var/www/gear-package --name="AppControllerSpecService" --type="Service" --extends="Mvc\\AbstractMvcTest"   --namespace="Mvc\\View\\App"
#php public/index.php gear module src create Gear /var/www/gear-package --name="AppServiceService" --type="Service" --extends="Mvc\\AbstractMvc" --dependency="Mvc\\View\\App\\AppServiceSpecService"  --namespace="Mvc\\View\\App"
#php public/index.php gear module src create Gear /var/www/gear-package --name="AppControllerService" --type="Service"  --extends="Mvc\\AbstractMvc"  --dependency="Mvc\\View\\App\\AppControllerSpecService"  --namespace="Mvc\\View\\App"
#php public/index.php gear module src create Gear /var/www/gear-package --name="AppService" --type="Service" --namespace="Constructor\\App" --dependency="Mvc\\View\\App\\AppServiceService,Mvc\\View\\App\\AppControllerService,\\GearJson\\Schema\\SchemaService"
#php public/index.php gear module controller create Gear /var/www/gear-package --name="AppController" --type=Console --namespace="Constructor\\App"

php public/index.php gear module activity create Gear /var/www/gear-package AppController --name="create" --dependency="Constructor\\App\\AppService"

ant unit 
exit 1 
php public/index.php gear module activity create Gear /var/www/gear-package AppController --name="delete"

ant unit 
exit 1



