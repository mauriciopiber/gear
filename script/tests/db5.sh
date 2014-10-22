#!/bin/bash
php ./../../public/index.php gear module delete Admin

php ./../../public/index.php gear module create Admin

php ./../../public/index.php gear db create Admin --table="Module"
php ./../../public/index.php gear db create Admin --table="Controller"
