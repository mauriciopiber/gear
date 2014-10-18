#!/bin/bash

php ../../../../public/index.php module create Admin --build


php ../../../../public/index.php gear src create Admin --type="Entity" --db=""
php ../../../../public/index.php gear src create Admin --type="EntityTest" --db=""
php ../../../../public/index.php gear src create Admin --type="Repository" --name="MyRepository" --db=""
php ../../../../public/index.php gear src create Admin --type="RepositoryTest" --name="MyRepositoryTest" --db=""
php ../../../../public/index.php gear src create Admin --type="Service" --name="MyService" --db=""
php ../../../../public/index.php gear src create Admin --type="ServiceTest" --name="MyServiceTest" --db=""
php ../../../../public/index.php gear src create Admin --type="Form" --name="MyForm" --db=""
php ../../../../public/index.php gear src create Admin --type="Filter" --name="MyFilter" --db=""
php ../../../../public/index.php gear src create Admin --type="Factory" --name="MyFactory" --db=""
php ../../../../public/index.php gear src create Admin --type="Controller" --name="MyController" --db=""
php ../../../../public/index.php gear src create Admin --type="ControllerTest" --name="MyControllerTest" --db=""


php ../../../../public/index.php gear src create Admin --type="Controller" --name="MyController" --db=""
php ../../../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=firstAction  --routePage="first-action"
php ../../../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=secondAction --routePage="second-action"
php ../../../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=thirdAction  --routePage="third-action"

php ../../../../public/index.php gear build Admin dev

php ../../../../public/index.php gear db create Admin --json=""

php ../../../../public/index.php module delete Admin

