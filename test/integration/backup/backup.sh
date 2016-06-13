#!/bin/bash

ls -l data

php public/index.php gear database module dump Gear

ls -l data

php public/index.php gear database module load Gear

ls -l data

rm data/gear.mysql.sql

ls -l data

php public/index.php gear database module load Gear

php public/index.php gear database module dump Gear

php public/index.php gear database module load Gear