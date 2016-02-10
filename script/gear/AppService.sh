#!/bin/bash


#php public/index.php gear schema src delete Gear /var/www/gear-package ControllerService Service
#php public/index.php gear module src create Gear --name="ControllerService" --type=Service --namespace=Mvc\\View\\App
php public/index.php gear module src create Gear --name="ServiceService" --type=Service --namespace=Mvc\\View\\App



#php public/index.php gear module src create Gear --name="AppService" --type=Service --namespace=Constructor\\Service --dependency="Mvc\View\App\ControllerService, Mvc\View\App\ServiceService"
