#!/bin/bash
echo "teste"
skeleton="https://github.com/zendframework/ZendSkeletonApplication.git"

nome=$1
host=$2
base=$3
diretorio="$base$1"
environment="development"

if [ -f $base/ZendSkeletonApplication ***REMOVED***;
then
    rm -R $base/ZendSkeletonApplication
fi

if [ -f $diretorio ***REMOVED***;
then
    rm -R $diretorio
fi


mkdir $diretorio

cd $base
git clone $skeleton
mv ZendSkeletonApplication/* $nome/
cd $diretorio
php composer.phar self-update

echo "Criando arquivo composer.json: "
echo "{
	\"name\" : \"mauriciopiber/$nome\",
	\"description\" : \"Enter description later\",
	\"keywords\" : [
		\"framework\",
		\"zf2\",
		\"php\"
	***REMOVED***,
	\"homepage\" : \"http://$nome.pibernetwork.com.br\",
	\"license\" : [
		\"BSD-3-Clause\"
	***REMOVED***,
	\"require\" : {
		\"php\" : \">=5.3.3\",
		\"zendframework/zendframework\" : \"2.3.*\"
	},
	\"require-dev\" : {
		\"mauriciopiber/gear\" : \"dev-master\"
	},
	\"repositories\" : [{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear.git\"
		}
	***REMOVED***
}" > $diretorio/composer.json
echo -n "[OK***REMOVED***"


php composer.phar install

#diretorio=$1
#echo ${diretorio}

# Limpando informacoes do virtual host
echo ""
echo "Removendo arquivo do virtual host: "
rm /etc/apache2/sites-available/$host.conf
echo -n "[OK***REMOVED***"

echo ""
echo ""
echo "Desabilitando virtual host:"
a2dissite $host
echo -n "[OK***REMOVED***"

# Gerando informacoes do virtual host
echo ""
echo ""
echo "Criando arquivo do virtual host: "
echo "<VirtualHost *:80>
	DocumentRoot \""$diretorio/public/"\"
	ServerName \""$host"\"
	SetEnv APPLICATION_ENV \"$environment\"
	<Directory \""$diretorio"\">
		Options Indexes MultiViews FollowSymLinks
		AllowOverride All
		Order allow,deny
		Allow from all
	</Directory>
</VirtualHost>" > /etc/apache2/sites-available/$host.conf
echo -n "[OK***REMOVED***"

echo ""
echo ""
echo "Habilitando virtual host: "
cd /etc/apache2/sites-enabled/
a2ensite $host
echo -n "[OK***REMOVED***"


echo ""
echo ""
echo "Alterando permissões do diretório: "
chmod 775 -R $host
echo -n "[OK***REMOVED***"

echo ""
echo ""
echo "Inserindo dominio no arquivo hosts: "
echo "127.0.0.1 $host" >> /etc/hosts
echo -n "[OK***REMOVED***"

echo ""
echo ""
echo "Reiniciando apache: "
/etc/init.d/apache2 force-reload
echo -n "[OK***REMOVED***"

echo ""
echo ""
echo "Virtual host gerado com sucesso! :)"
echo ""

cat /etc/exports | grep "$diretorio"

if [ "$?" == 1 ***REMOVED***; then
echo "Setting new Entry for file"
sudo chmod 777 /etc/exports
sudo echo "$diretorio *(rw,sync,no_subtree_check)"  >> /etc/exports
sudo service nfs-kernel-server restart
echo "Folder exported successful"
fi

echo "Create Application Config"
echo ""
echo "<?php
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'Gear'
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
);" > $diretorio/config/application.config.php
echo ""
echo -n "[OK***REMOVED***"
echo ""


