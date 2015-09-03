#!/bin/bash
projectDir=${1}
projectHost=${2}
projectEnvironment="development"

# Limpando informacoes do virtual host
echo ""
echo "Removendo arquivo do virtual host: "
rm /etc/apache2/sites-available/$projectHost.conf
echo -n "[OK***REMOVED***"

echo ""
echo "Desabilitando virtual host:"
/usr/sbin/a2dissite $projectHost
echo -n "[OK***REMOVED***"

# Gerando informacoes do virtual host
echo ""
echo ""
echo "Criando arquivo do virtual host: "
echo "<VirtualHost *:80>
	DocumentRoot \""$projectDir/public/"\"
	ServerName \""$projectHost"\"
	SetEnv PHINX_ENVIRONMENT \"$projectEnvironment\"
	<Directory \""$projectDir"\">
		Options Indexes MultiViews FollowSymLinks
		AllowOverride All
		Order allow,deny
		Allow from all
	</Directory>
</VirtualHost>" > /etc/apache2/sites-available/$projectHost.conf
echo -n "[OK***REMOVED***"

echo ""
echo "Habilitando virtual host: "
cd /etc/apache2/sites-enabled/
/usr/sbin/a2ensite $projectHost
echo -n "[OK***REMOVED***"

echo ""
echo ""
echo "Inserindo dominio no arquivo hosts: "
echo "127.0.0.1 $projectHost" >> /etc/hosts
echo -n "[OK***REMOVED***"

echo ""
echo ""
echo "Reiniciando apache: "
/etc/init.d/apache2 force-reload
echo -n "[OK***REMOVED***"

echo ""
echo ""
echo "Virtual host gerado com sucesso! :)"
echo -n "[OK***REMOVED***"