#!/bin/bash
php ./../../public/index.php gear module delete TestController
php ./../../public/index.php gear module create TestController

php ../../public/index.php gear controller create Admin --name=MyController --invokable=%s\Controller\My
php ../../public/index.php gear controller create Admin --name=MySecondController --invokable=%s\Controller\MySecond
php ../../public/index.php gear controller create Admin --name=MyThirdController --invokable=Funk
php ../../public/index.php gear controller create Admin --name=MyController --invokable=Funk
php ../../public/index.php gear controller create Admin --name="MyAwesome3Controller" --invokable="%s\Controller\Teste"

php ./../../public/index.php gear build Admin dev

php ./../../public/index.php gear module delete TestController