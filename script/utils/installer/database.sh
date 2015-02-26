#!/bin/bash
database=${1}
username=${2}
password=${3}
mysql -u $username -h localhost -p$password -Bse "CREATE DATABASE IF NOT EXISTS $database;"

echo "Banco de dados $database criado."
echo "[OK***REMOVED***"