#!/bin/bash
echo "Generating sqlite dump and db from mysql"

db=${1}
dump=${2}
mysql=${5}
user=${3}
pass=${4}

mysql2sqlite.sh $mysql -u $user -p$pass  | sqlite3 $db
sudo chmod 777 $db

sqlite3 data/$db .dump > $dump

echo "Sqlite from Mysql Ok"