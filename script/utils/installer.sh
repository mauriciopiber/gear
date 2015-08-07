#!/bin/bash
scriptDir=${1}
baseDir=${2}
projectName=${3}
projectDir=${4}
projectHost=${5}
projectGit=${6}
database=${7}
username=${8}
password=${9}
projectNameUrl=${10}

###instalação básica
#Clonar ZF2 Skeleton
#Criar composer.json
#Executar composer install

echo "Executando instalação dos componentes"
echo ""

/bin/bash ${1}/installer/composer.sh $baseDir $projectDir $projectName

echo "Execução da instalação dos componentes realizada com sucesso"
echo ""
###instalação avançada
#Criar application.config.php

echo "Criando arquivo application.config.php"
echo ""

/bin/bash ${1}/installer/application.config.sh $projectDir

echo "Arquivo application.config.php criado com sucesso"
echo ""

#Criar pasta data/logs e permissao
/bin/bash ${1}/installer/permission.sh $projectDir

#Criar index.php
/bin/bash ${1}/installer/index.sh $projectDir
#Criar init_autoloader.php
/bin/bash ${1}/installer/init_autoloader.sh $projectDir

###instalação banco de dados
#Criar banco de dados
/bin/bash ${1}/installer/database.sh $database $username $password


#Criar configuração banco/migrations
/bin/bash ${1}/installer/phinx.sh $projectDir $database $username $password


#Copiar migrations para data/migrations
/bin/bash ${1}/installer/copy-migration.sh $projectDir

#Executar migrations
/bin/bash ${1}/installer/run-migration.sh $projectDir

#Criar especificaçao de ambiente na pasta data/specification
/bin/bash ${1}/installer/specification.sh $projectDir $projectNameUrl $database $username $password

exit 0

