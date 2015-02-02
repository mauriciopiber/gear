Gear Full Suite.

Versão 0.2.0

Funcionalidades incluídas

###1. Project:
####1.1 - Gerar novo projeto para começar a ser utilizado para desenvolvimento
```
index.php gear project (create|delete) <project> <host> <git>
```

####1.2 - Gerar arquivo com configurações globais.
```
index.php gear project setUpGlobal --host= --dbname=  --dbms= --environment=
```


####1.3 - Gerar arquivo com configurações locais.
```
index.php gear project setUpLocal --username= --password=

```

####1.4 - Gerar arquivo com environment.
```
index.php gear project setUpEnvironment --environment=
```


####1.5 - Gerar arquivos de configuração (global, local, environment).
```
index.php gear project setUpConfig --host= --dbname=  --username= --password= --environment= --dbms=
```


####1.6 - Gerar banco de dados setado em global em Mysql.
```
index.php gear project setUpMysql --dbname= --username= --password=

```


####1.7 - Gerar banco de dados setado em global em Sqlite.
```
index.php gear project setUpSqlite --dbname= --dump= [--username=***REMOVED*** [--password=***REMOVED***
```

####1.9 - Gerar dados ACL para banco.
```
index.php gear project acl
```

####1.10 - Gerar entidades doctrine do banco de dados.
```
index.php gear project setUpEntities
```


###2. Module:


####2.1 - Gerar novo módulo.
```
index.php gear module create <module>
```

####2.2 - Remover módulo do disco permanentemente.
```
index.php gear module delete <module>
```

####2.3 - Gerar novo módulo.
```
index.php gear module create <module> --light [--ci***REMOVED*** [--build=***REMOVED*** [--doctrine-fixture***REMOVED*** [--unit***REMOVED*** [--codeception***REMOVED*** [--acl***REMOVED***

```
|parameter | does |
|-|-----------|
|--ci| continuous integration folders and files|
|--build=|run a build after creation.|
|--doctrine-fixture| fixture folder and config.|
|--unit| folder and files to run phpunit tests|
|--codeception| folder and files to run codeception tests|
|--acl| folder, file and config to run acl up command from gear.|

####2.4 - Carregar Módulo.
```
index.php gear module load <module> --before= --after=
```

####2.5 - Descarregar Módulo.
```
index.php gear module unload <module>
```

####2.6 - Rodar e exibir Build do Ant Build.xml.
```
index.php gear module build <module> --trigger= --domain=
```

####2.7 - Rodar composer commit e criar tags do módulo
```
index.php gear module push <module> --description=
```

####2.8 - Gerar e exibir Gear Schema.
```
index.php gear module dump <module> [--json***REMOVED*** [--array***REMOVED***
```

####2.9 - Gear todas entidades disponíveis no módulo específicado.
```
index.php gear module entities <module>
```


####2.10 - Gear lista de entidades informadas no módulo específicado.
```
index.php gear module entity <module> [--entity=***REMOVED***
```


###3. Constructor:
####3.1 - Gerar DB.
```
index.php gear db create <module> --table= [--columns=***REMOVED*** [--user=***REMOVED*** [--default-role=***REMOVED***
```

|parameter | does |
|-|-----------|
| columns | json com informações sobre campos especiais |
| user | qual perfil de usuários será utilizado |
| default-role | qual perfil de ACL será utilizada |

####3.2 - Gerar SRC.
```
index.php gear src create <module> --type= --name= [--abstract***REMOVED*** [--dependency==***REMOVED*** [--extends=***REMOVED*** [--db=***REMOVED*** [--columns=***REMOVED***
```
|parameter | does |
|-|-----------|
| columns | json com informações sobre campos especiais |
| db | qual db será utilizado na criação da classe |
| abstract | a classe informada deve ser abstrada? |
| dependency | quais dependências a classe deverá utilizar |
| extends | a classe deve extendar qual classe do sistema? |
| type | repository, service, form, filter, factory, search, controller, controller/plugin |
| name | qual o nome que a classe deverá ser criada |

####3.3 - Gerar Controller.
```
index.php gear controller create <module> --name= --invokable=
```

####3.4 - Gerar Action.
```
index.php gear activity create <module> <parent> --name= [--role=***REMOVED*** [--dependency=***REMOVED*** [--routeConsole=***REMOVED*** [--routeHttp=***REMOVED***
```

####3.5 - Gerar Test.
```
index.php gear test create <module> --suite= --targetDir=
```

####3.6 - Gerar View.
```
index.php gear src create <module> --targetDir=
```



###5. Gear:
####5.1 - Versão
```
index.php  gear --version|-v
```



Pibernetwork © All Rights Reserved.
