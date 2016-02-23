#!/bin/bash


#
php public/index.php gear module src create Gear \
    --name="AppServiceSpecService" \
    --type="Service" \
    --extends="Mvc\\AbstractMvcTest" \
    --namespace="Mvc\\View\\App" \
/

php public/index.php gear module src create Gear \
    --name="AppControllerSpecService" \
    --type="Service" \
    --extends="Mvc\\AbstractMvcTest" \   
    --namespace="Mvc\\View\\App" \
\


#php public/index.php gear module src create Gear \
    --name="AppServiceService" \
    --type="Service" \
    --extends="Mvc\\AbstractMvc" \
    --dependency="Mvc\\View\\App\\AppServiceSpecService"  \
    --namespace="Mvc\\View\\App" \
\

php public/index.php gear module src create Gear \
    --name="AppControllerService" \
    --type="Service"  \
    --extends="Mvc\\AbstractMvc"  \
    --dependency="Mvc\\View\\App\\AppControllerSpecService" \
     --namespace="Mvc\\View\\App"\
\    

php public/index.php gear module src create Gear \
    --name="AppService" \
    --type="Service" \
    --namespace="Constructor\\App" \
    --dependency="Mvc\\View\\App\\AppServiceService,Mvc\\View\\App\\AppControllerService,\\GearJson\\Schema\\SchemaService"
\

php public/index.php gear module controller create Gear \
    --name="AppController" \
    --type=Console \
    --namespace="Constructor\\App"
\
    
php public/index.php gear module activity create Gear AppController \
    --name="create" \
    --dependency="Constructor\\App\\AppService"
\

php public/index.php gear module activity create Gear AppController \
    --name="delete" \
\


