Gear project.

available commands:

#1 - Gerar .htaccess com o ambiente desejado.
index.php gear environment <environment>

Modifica o arquivo .htaccess para o ambiente declarado.

#2 - Gerar a configuração necessária para rodar os testes tanto em dev quanto em stag para sqlite. [Testes são desencorajados em produção, só testes de compatibilidade***REMOVED***.
index.php gear sqlite (--from-mysql|--from-schema) --db= --dump=

Criar um banco de dados de acordo com o schema ou o mysql na localização definida em "db".
Faz um backup em SQL do banco de dados e salva em "dump".


#3 - Gerar e exibir as configurações distribuídas entre o schema dos módulos do projeto.
index.php gear dump [--module=***REMOVED*** (--json|--array)

Imprime no console o json ou array das configurações schema do projeto completo, para todos módulos carregados.
Caso queria exibir a informação de apenas um módulo, especificar em --module.


#4 - Gerar as informação no banco de dados referentes as configurações schema - page dos módulos do projeto.
index.php gear acl

Responsável por carregar todas configurações dos módulos ativos e salvar os ACLs no banco de dados.
Função necessita do módulo minimal-admin para funcionar, ou de um administrador da pibernetwork, não possui nativo em Gear.
Percorre todos módulos com o parametro 'acl' => array('nomedoModulo' => true) no config/module.config.php

#5 - Carregar ou descarregar determinado módulo das configurações do sistema.
index.php gear load [--unload***REMOVED*** <module>

Responsável por carregar um módulo no application.config da aplicação onde está instalado.
Quando passado --unload, o mesmo faz o serviço de descarregar o módulo do arquivo.

#6 - Gerar um novo projeto para começar a ser utilizado para desenvolvimento

index.php gear project (create|delete) <project> <host> <git>

Responsável por criar um novo projeto.
Faz o download do ZendFrameworkSkeleton
Configura NFS-Server 
**Implementar Samba para windows**
Configura virtualhost
Configura application.config.php para módulos básicos
Configura composer.json para os módulos básicos
Roda o composer.


#7 - Gerar um novo modulo para começar a ser utilizado para desenvolvimento
index.php gear module (create|delete) <module>

#8 - Rodar a build de determinado 
index.php gear build <module> <build>


#9 - Gerar os arquivos únicos para começar a utilizar para desenvolvimento
index.php gear src

#10 - Gerar as páginas únicas para começar a utilizar para desenvolvimento
index.php gear page

#11 - Gerar o crud completo entre arquivos, páginas e testes para utilizar para desenvolvimento, e também para ser production-ready
index.php gear db
