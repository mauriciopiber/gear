#!/bin/bash

build=${1}
flag=${2}

basedir=$(dirname "$0")
fullpath=$(realpath $basedir)
base="/var/www/gear-package"

gearpath="$base/gear"

module=PiberMoney
modulepath="$base/piber-money"
database="piber_money"

echo "$fullpath Module Money"

date="$(date +'%Y%m%d%H%M%S')"

if [ "$flag" == "Install" ***REMOVED***; then

    sudo rm -R "$modulepath/src"
    sudo rm -R "$modulepath/test"
    sudo rm -R "$modulepath/public"

    $modulepath/vendor/bin/database $database root gear

    sudo php public/index.php gear schema delete $module $base
    sudo php public/index.php gear module-as-project create $module $base --type=web --force
    cd $modulepath && sudo script/deploy-development.sh

fi

date="$(date +'%Y%m%d%H%M%S')"
sudo rm $modulepath/data/migrations/*wallet.php
sudo cp "$fullpath/wallet/wallet.php" "$modulepath/data/migrations/${date}_wallet.php"

sleep 1

date="$(date +'%Y%m%d%H%M%S')"
sudo rm $modulepath/data/migrations/*expense.php
sudo cp "$fullpath/expense/expense.php" "$modulepath/data/migrations/${date}_expense.php"

sleep 1

date="$(date +'%Y%m%d%H%M%S')"
sudo rm $modulepath/data/migrations/*billing.php
sudo cp "$fullpath/billing/billing.php" "$modulepath/data/migrations/${date}_billing.php"


cd $modulepath && sudo vendor/bin/phinx migrate
cd $modulepath && sudo vendor/bin/unload-module BjyAuthorize
cd $modulepath && sudo php public/index.php gear database fix table Wallet
cd $modulepath && sudo php public/index.php gear database fix table Expense
cd $modulepath && sudo php public/index.php gear database fix table ExpenseCycle
cd $modulepath && sudo php public/index.php gear database fix table ExpenseRule
cd $modulepath && sudo php public/index.php gear database fix table Billing
cd $modulepath && sudo php public/index.php gear database fix table BillingWallet
cd $modulepath && sudo php public/index.php gear database fix table Project
cd $modulepath && sudo php public/index.php gear database fix table Customer


cd $gearpath && sudo php public/index.php gear module construct $module $base --file="$basedir/wallet/wallet.yml"
cd $gearpath && sudo php public/index.php gear module construct $module $base --file="$basedir/expense/expense.yml"
cd $gearpath && sudo php public/index.php gear module construct $module $base --file="$basedir/billing/billing.yml"



cd $modulepath && sudo script/load.sh
cd $modulepath && ant