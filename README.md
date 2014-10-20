Gear project.

available commands:

#1 
index.php gear environment <environment>

Modifica o arquivo .htaccess para o ambiente declarado.

#2
index.php gear sqlite (--from-mysql|--from-schema) --db= --dump=

Criar um banco de dados de acordo com o schema ou o mysql na localização definida em "db".
Faz um backup em SQL do banco de dados e salva em "dump".
#Principal Objetivo é garantir que os testes unitários funcionem corretamente de acordo com a configuração do codeception/ant build.


#3
index.php gear dump [--module=***REMOVED*** (--json|--array)

Imprime no console o json ou array das configurações schema do projeto completo, para todos módulos carregados.
Caso queria exibir a informação de apenas um módulo, especificar em --module.


#4
index.php gear acl

Responsável por carregar todas configurações dos módulos ativos e salvar os ACLs no banco de dados.
Função necessita do módulo minimal-admin para funcionar, ou de um administrador da pibernetwork, não possui nativo em Gear.
Percorre todos módulos com o parametro 'acl' => array('nomedoModulo' => true) no config/module.config.php

#5
index.php gear load [--unload***REMOVED*** <module>

Responsável por carregar um módulo no application.config da aplicação onde está instalado.
Quando passado --unload, o mesmo faz o serviço de descarregar o módulo do arquivo.

#6 
index.php gear project (create|delete) <project> <host> <git>

Responsável por criar um novo projeto.
Faz o download do ZendFrameworkSkeleton
Configura NFS-Server 
**Implementar Samba para windows**
Configura virtualhost
Configura application.config.php para módulos básicos
Configura composer.json para os módulos básicos
Roda o composer.


#7
index.php gear module (create|delete) <module>

#8
index.php gear build <module> <build>


#9
index.php gear src

#10
index.php gear page

#11 
index.php gear db
