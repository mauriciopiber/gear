#!/bin/bash
php ./../../public/index.php gear module delete Admin
php ./../../public/index.php gear module create Admin

php ./../../public/index.php gear src create Admin --type="Service" --name="MyService"
php ./../../public/index.php gear build Admin dev