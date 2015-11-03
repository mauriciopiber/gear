#!/bin/bash

base="/var/www/Gear"
index="$base/public/index.php"

php $index gear jenkins create job
php $index gear jenkins update job
php $index gear jenkins delete job
php $index gear jenkins read job