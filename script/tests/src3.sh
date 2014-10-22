#!/bin/bash
php ./../../public/index.php gear module delete Admin
php ./../../public/index.php gear module create Admin

php ./../../public/index.php gear src create Admin --type="Service" --name="MyService"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyService"

php ./../../public/index.php gear src create Admin --type="Entity" --name="MyEntity"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyEntity"
#php ./../../public/index.php gear build Admin dev
php ./../../public/index.php gear src create Admin --type="Repository" --name="MyRepository"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyRepository"

php ./../../public/index.php gear src create Admin --type="Form" --name="MyForm"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyForm"

php ./../../public/index.php gear src create Admin --type="Filter" --name="MyFilter"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyFilter"

php ./../../public/index.php gear src create Admin --type="Factory" --name="MyFactory"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyFactory"

php ./../../public/index.php gear src create Admin --type="ValueObject" --name="MyValueObject"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyValueObject"


php ./../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=MyAction --routePage=my-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Admin --controllerPage=MySecondController --actionPage=MySecondAction --routePage=my-second-action --rolePage=guest --invokablePage="%s\Controller\MySecond"
php ./../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=MergeAction --routePage=merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=TwoMergeAction --routePage=two-merge-action --rolePage=guest --invokablePage="%s\Controller\My"


php ./../../public/index.php gear build Admin dev
#php ./../../public/index.php gear src create Admin --type="Controller" --name="MyController"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyController"

#php ./../../public/index.php gear src create Admin --type="ControllerPlugin" --name="MyControllerPlugin"
#php ./../../public/index.php gear build Admin phpunit-group --domain="MyControllerPlugin"


#php ./../../public/index.php gear module delete Admin


#php ./../../public/index.php gear build Admin dev

#php ./../../public/index.php gear db create Admin --json=""

#php ./../../public/index.php module delete Admin

