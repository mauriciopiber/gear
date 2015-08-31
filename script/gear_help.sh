#!/bin/bash
base="/var/www/Gear"
index="$base/public/index.php"
### Script responsável por facilitar os trabalhos massantes.
### Requisíto básico, o comando deve ser disparado sem nenhum parámetro.

# Função responsável por fazer o backup das informações em desenvolvimento para salvar o estado atual e a recuperação do mesmo após criar o testes.
# Deve salvar:
# Pasta de Upload.
# Banco de Dados.
# Obs: Como o backup é para desenvolvimento, o backup deve ser mantido numa pasta separada em Data/Backup com a data do dia que foi realizada a mesma.
function make_backup
{
	ls -l data/Backup &> /dev/null

	if [ "$?" != "0" ***REMOVED***; then
		mkdir data/Backup
		chmod 777 data/Backup
	fi

	date=`date +%Y-%m-%d-%H-%M-%S`
	mkdir data/Backup/$date

	unload_acl

	php public/index.php gear database mysql dump data/Backup/$date/ snapshot.sql

	load_acl

	ls -l public/upload &> /dev/null

	if [ "$?" == "0" ***REMOVED***; then
		cp -R public/upload data/Backup/$date/upload
	fi


	tar -cf data/Backup/$date.tar data/Backup/$date
	bzip2 data/Backup/$date.tar

	rm -R data/Backup/$date
}


# Função responsável por limpar as pastas de upload e o banco, capaz de converter o estado do sistema para o estado que quiser em determinada data.
function load_backup
{
	ls -l data/Backup &> /dev/null

	if [ "$?" != "0" ***REMOVED***; then
		echo "There is no snapshot yet"
		exit 1
	fi


	ls -la data/Backup

	echo -n "What snapshot do you want do load? > "
	read text

	ls -l data/Backup/$text.tar.bz2 &> /dev/null

	if [ "$?" != "0" ***REMOVED***; then
		echo "Wrong snapshot name"
		exit 1
	fi

	tar xjvf data/Backup/$text.tar.bz2


	ls -l data/Backup/$text/snapshot.sql &> /dev/null

	if [ "$?" == "0" ***REMOVED***; then

		unload_acl
		php public/index.php gear database mysql load data/Backup/$date/snapshot.sql

		force_reload_cache
		rm data/Backup/$text/snapshot.sql

	fi

	ls -l data/Backup/$text/upload &> /dev/null

	if [ "$?" == "0" ***REMOVED***; then
		rm -R public/upload
		mv data/Backup/$text/upload public/upload
	fi

}

function local
{
	cp config/autoload/local.php.dist config/autoload/local.php
}

function clone
{
	ls -l $1 &> /dev/null

	if [ "$?" == 2 ***REMOVED***; then
		sudo git clone $2
		mv $3 $1
	fi
}

function do_push
{
	msg=$1
	php public/index.php gear module push Gear --description=$msg
	php public/index.php gear module push GearBase --description=$msg
	php public/index.php gear module push GearEmail --description=$msg
	php public/index.php gear module push GearBackup --description=$msg
	php public/index.php gear module push GearAdmin --description=$msg
	php public/index.php gear module push GearImage --description=$msg
	php public/index.php gear module push GearJson --description=$msg
	php public/index.php gear module push GearAcl --description=$msg
	php public/index.php gear module push GearVersion --description=$msg
}

function git_status
{
	cd $1
	pwd
	git status
}

function get_git_status
{
	echo "   "
	echo "   "
	git_status $base/module/Gear
	git_status $base/module/GearBase
	git_status $base/module/GearEmail
	git_status $base/module/GearBackup
	git_status $base/module/GearAdmin
	git_status $base/module/GearImage
	git_status $base/module/GearJson
	git_status $base/module/GearAcl
	git_status $base/module/GearVersion
}

function do_install
{
	mysql -uroot -pgear -e "CREATE DATABASE IF NOT EXISTS gear"

	cd module

	clone Gear git@bitbucket.org:mauriciopiber/gear.git gear
	clone GearBase git@bitbucket.org:mauriciopiber/gear-base.git gear-base
	clone GearEmail git@bitbucket.org:mauriciopiber/gear-email.git gear-email
	clone GearBackup git@bitbucket.org:mauriciopiber/gear-backup.git gear-backup
	clone GearAdmin git@bitbucket.org:mauriciopiber/gear-admin.git gear-admin
	clone GearImage git@bitbucket.org:mauriciopiber/gear-image.git gear-image
	clone GearJson git@bitbucket.org:mauriciopiber/gear-json.git gear-json
	clone GearAcl git@bitbucket.org:mauriciopiber/gear-acl.git gear-acl
	clone GearVersion git@bitbucket.org:mauriciopiber/gear-version.git gear-version

	cd ..

	local

	echo "<?php
	return array(
	    'modules' => array(
	    	'AssetManager',
	        'DoctrineModule',
	        'DoctrineORMModule',
	        'ZfcBase',
	        'ZfcUser',
	        'ZfcUserDoctrineORM',
	        'GearBase',
	        'Gear',
	        'GearEmail',
	        'GearAdmin',
	        'GearJson',
	        'GearAcl',
	        'GearImage',
	        'GearBackup',
	        'GearVersion'
	    ),
	    'module_listener_options' => array(
	        'module_paths' => array(
	            './module',
	            './vendor',
	        ),
	        'config_glob_paths' => array(
	            'config/autoload/{,*.}{global,local}.php',
	        ),
	    ),
	);" > config/application.config.php
}


function clear_project
{
	files=($(find public/upload/ -type f ))
	for item in ${files[****REMOVED***}
	do
		if [[ "$item" != *.gitignore ***REMOVED******REMOVED***; then
			rm $item
		fi

	done

	ls -l data/logs/* &> /dev/null

	if [ "$?" == "0" ***REMOVED***; then
		rm -R data/logs/*
	fi
}

function force_reload_cache
{
	unload_acl
	php public/index.php gear cache renew --data
	php public/index.php gear cache renew --memcached
	php public/index.php gear module load BjyAuthorize --after=ZfcUserDoctrineORM
}

# Função responsável por fazer o backup das informações em produção do sistema e mandar para o Git.
function make_snapshot
{
	ls -l data/Snapshot &> /dev/null

	if [ "$?" != "0" ***REMOVED***; then

		mkdir data/Snapshot
		chmod 777 data/Snapshot

	fi

	date=`date +%Y-%m-%d-%H-%M-%S`

	mkdir data/Snapshot/$date

	database=$(php -r '$global = require_once("config/autoload/global.php"); echo $global["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["dbname"***REMOVED***;')
	username=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["user"***REMOVED***;')
	password=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["password"***REMOVED***;')

	/usr/bin/mysqldump -u$username -p$password $database --opt > data/Snapshot/$date/snapshot.sql

	ls -l public/upload &> /dev/null

	if [ "$?" == "0" ***REMOVED***; then
		cp -R public/upload data/Snapshot/$date/upload
	fi

	tar -cf data/Snapshot/$date.tar data/Snapshot/$date
	bzip2 data/Snapshot/$date.tar

	rm -R data/Snapshot/$date
}

function load_snapshot
{
	ls -l data/Snapshot &> /dev/null

	if [ "$?" != "0" ***REMOVED***; then
		echo "There is no snapshot yet"
		exit 1
	fi

	ls -la data/Snapshot

	echo -n "What snapshot do you want do load? > "
	read text

	ls -l data/Snapshot/$text.tar.bz2 &> /dev/null

	if [ "$?" != "0" ***REMOVED***; then
		echo "Wrong snapshot name"
		exit 1
	fi

	tar xjvf data/Snapshot/$text.tar.bz2


	ls -l data/Snapshot/$text/snapshot.sql &> /dev/null

	if [ "$?" == "0" ***REMOVED***; then

		database=$(php -r '$global = require_once("config/autoload/global.php"); echo $global["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["dbname"***REMOVED***;')
		username=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["user"***REMOVED***;')
		password=$(php -r '$local = require_once("config/autoload/local.php"); echo $local["doctrine"***REMOVED***["connection"***REMOVED***["orm_default"***REMOVED***["params"***REMOVED***["password"***REMOVED***;')

		/usr/bin/mysql -u$username -p$password -e "CREATE DATABASE IF NOT EXISTS $database"
		/usr/bin/mysql -u$username -p$password $database < data/Snapshot/$text/snapshot.sql
		force_reload_cache
		rm data/Snapshot/$text/snapshot.sql

	fi

	ls -l data/Snapshot/$text/upload &> /dev/null

	if [ "$?" == "0" ***REMOVED***; then
		rm -R public/upload
		mv data/Snapshot/$text/upload public/upload
	fi

}

function module_version
{
	data=$('./data/gear_help.php')
	for module in $data
	do
		php public/index.php gear module -v $module
	done
}


function unload_acl
{
	sudo sed -i -- "s/'BjyAuthorize', / /g" config/application.config.php
	sudo sed -i -- "s/'BjyAuthorize',/ /g" config/application.config.php
}

function load_acl
{
	php public/index.php gear module load BjyAuthorize --after=ZfcUserDoctrineORM
}

function reload_acl
{
	unload_acl
	php public/index.php gear cache renew --data
	php public/index.php gear project setUpAcl
	php public/index.php gear cache renew --memcached
	php public/index.php gear cache renew --data
	load_acl
}

function reload_db
{
	unload_acl
	php public/index.php gear cache renew --data
	php public/index.php gear project fixture --reset-autoincrement
	php public/index.php gear project setUpAcl
	php public/index.php gear cache renew --memcached
	load_acl
}



function generate_db
{
	data=$('./data/gear_help.php')
	for module in $data
	do
		moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
		php public/index.php gear database mysql dump $base/module/$module/data/ $moduleUrl.mysql.sql
	done
}

function persist_db
{
	php public/index.php gear database mysql dump $base/ persist.sql
}

function load_db
{
	php public/index.php gear database mysql load $base/persist.sql
}

function run_test
{
	suite=$1
	data=$('./data/gear_help.php')
	for module in $data
	do

		php public/index.php gear module build $module --trigger=$suite
	done
}


function create_coverage_link
{
	module=$1
	moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)

	ls -l $base/public/$moduleUrl-coverage &> /dev/null

	if [ "$?" != 0 ***REMOVED***; then

		ln -s $base/module/$module/build/coverage/coverage $base/public/$moduleUrl-coverage
	fi
}

function create_record_link
{
	module=$1
	moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)

	ls -l $base/public/$moduleUrl-record &> /dev/null

	if [ "$?" != 0 ***REMOVED***; then

		ln -s $base/module/$module/build/coverage $base/public/$moduleUrl-record
	fi
}

function dump_db
{
	module=$1
	moduleUrl=$(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< $module)
	php public/index.php gear database mysql dump $base/module/$module/data/ $moduleUrl.mysql.sql
}


function build_single
{
	module=$1
	php public/index.php gear module build $module --trigger=unit
	php public/index.php gear module build $module --trigger=acceptance
	php public/index.php gear module build $module --trigger=functional
	php public/index.php gear module build $module --trigger=phpcs
	php public/index.php gear module build $module --trigger=phpmd
	php public/index.php gear module build $module --trigger=phpcpd
}


function gear_form
{
	name=$1
	php public/index.php gear module src create $module --type="Form" --name="${name}Form"
	php public/index.php gear module src create $module --type="Filter" --name="${name}Filter"
	php public/index.php gear module src create $module --type="Factory" --name="${name}FormFactory" --dependency="Form\\${name},Filter\\${name}" --template="Form"
}

function gear_service
{
	name=$1
	php public/index.php gear module src create $module --type="Repository" --name="${name}Repository"
	php public/index.php gear module src create $module --type="Service" --name="${name}Service" --dependency="Repository\\${name}Repository"
}

if [ $(pwd) != $base ***REMOVED***; then
	cd $base
fi;

################### COMANDOS ##################3


command=$1

if [ "$command" == "help" ***REMOVED*** || [ "$command" == "" ***REMOVED***; then

#module_version

echo "Avaiable Commands:"
echo "load-testing       - create a backup, reload db and generate all modules files"
echo "reload-db          - unload-acl, run gear fixture, run gear setUpAcl, load-acl"
echo "unload-acl         - unload BhyAuthorize on config/application.config.php"
echo "load-acl           - load BhyAuthorize on config/application.config.php"
echo "make-snapshot      - save working state database and upload folder to data/Snapshot folder."
echo "load-snapshot      - copy data/Snapshot data the currencty working state."
echo "make-backup        - save working state database and upload folder to data/Backup folder."
echo "load-backup        - copy data/Backup data the currencty working state."
echo "clear              - erase upload and logs data"
echo "make-sql-dump      - generate DB's modules test file to working with codeception in each module"
echo "install            - install project"
echo "build-test         - reload db and generate *.mysql.sql for all modules"
echo "reload-acl         - drop cache, reload acl from schema"
fi

if [ "$command" == "build-test" ***REMOVED***; then
reload_db
generate_db
exit 0
fi

if [ "$command" == "reload-acl" ***REMOVED***; then
reload_acl
exit 0
fi

if [ "$command" == "load-acl" ***REMOVED***; then
load_acl
exit 0
fi

if [ "$command" == "load-testing" ***REMOVED***; then
make_backup_development
reload_db
generate_db
exit 0
fi

if [ "$command" == "git-status" ***REMOVED***; then
get_git_status
exit 0
fi


if [ "$command" == "make-snapshot" ***REMOVED***; then
make_snapshot
exit 0
fi

if [ "$command" == "load-snapshot" ***REMOVED***; then
load_snapshot
exit 0
fi

if [ "$command" == "install" ***REMOVED***; then
do_install
exit 0
fi

if [ "$command" == "clear" ***REMOVED***; then
clear_project
exit 0
fi

if [ "$command" == "rebuild" ***REMOVED***; then
clear_project
reload_db
exit 0
fi

if [ "$command" == "make-sql-dump" ***REMOVED***; then
generate_db
exit 0
fi

if [ "$command" == "reload-db" ***REMOVED***; then
reload_db
exit 0
fi

if [ "$command" == "unload-acl" ***REMOVED***; then
unload_acl
exit 0
fi