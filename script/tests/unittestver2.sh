#!/bin/bash
php ./../../public/index.php gear module delete Admin
php ./../../public/index.php gear module create Admin


php ./../../public/index.php gear src create Admin --type="Entity" --name="MyEntity"
php ./../../public/index.php gear src create Admin --type="Repository" --name="MyRepository"
php ./../../public/index.php gear src create Admin --type="Service" --name="MyService"
php ./../../public/index.php gear src create Admin --type="Form" --name="MyForm"
php ./../../public/index.php gear src create Admin --type="Filter" --name="MyFilter"
php ./../../public/index.php gear src create Admin --type="Factory" --name="MyFactory"
php ./../../public/index.php gear src create Admin --type="Controller" --name="MyController"


#php ./../../public/index.php gear build Admin dev

#php ./../../public/index.php gear db create Admin --json=""

#php ./../../public/index.php module delete Admin

