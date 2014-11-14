#!/bin/bash

#php ./../../public/index.php gear build Gear phpunit

php ./../../public/index.php gear module delete Power
php ./../../public/index.php gear module create Power

php ./../../public/index.php gear db create Power --table="Controller"
php ./../../public/index.php gear db create Power --table="Controller"
php ./../../public/index.php gear db create Power --table="Controller"
php ./../../public/index.php gear db create Power --table="Controller"
php ./../../public/index.php gear db create Power --table=Produto --columns="{\"destaque\": \"simple-checkbox\"}"
php ./../../public/index.php gear db create Power --table=Produto --columns="{\"destaque\": \"simple-checkbox\"}"