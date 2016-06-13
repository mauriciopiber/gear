#!/bin/bash

ls -l data

php public/index.php gear database module dump

ls -l data

php public/index.php gear database module load

ls -l data

rm data/gear.mysql.sql

ls -l data

php public/index.php gear database module load

php public/index.php gear database module dump

php public/index.php gear database module load