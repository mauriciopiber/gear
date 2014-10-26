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


####1.8 - Gerar e exibir Gear Schema.
```
index.php gear project dump <module> [--json***REMOVED*** [--array***REMOVED***
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

####2.3 - Carregar Módulo.
```
index.php gear module load <module>
```

####2.4 - Descarregar Módulo.
```
index.php gear module unload <module>
```

####2.5 - Carregar módulo antes de outro módulo
```
index.php gear module load <module> --before=
```

###3. Constructor:
####3.1 - Gerar DB.
```
index.php gear db create <module> --table=
```

####3.2 - Gerar Page.
```
index.php gear page create <module> --controllerName= --controllerInvokable= --actionName= [--actionRoute=***REMOVED*** [--actionRole=***REMOVED*** [--actionDependency=***REMOVED***
```

####3.3 - Gerar SRC.
```
index.php gear src create <module> --type= --name= [--dependency=***REMOVED*** [--extends=***REMOVED*** [--db==***REMOVED***
```

####3.4 - Gerar Controller.
```
index.php gear controller create <module> --name= --invokable=
```

####3.5 - Gerar Action.
```
index.php gear activity create <module> <parent> --name= [--role=***REMOVED*** [--dependency=***REMOVED*** [--routeConsole=***REMOVED*** [--routeHttp=***REMOVED***
```

####3.6 - Gerar Test.
```
index.php gear test create <module> --suite= --targetDir=
```

####3.7 - Gerar View.
```
index.php gear src create <module> --targetDir=
```

###4. Build:
####4.1 - Rodar e exibir Build do Ant Build.xml.
```
index.php gear build <module> --build= --domain=
```

###5. Gear:
####5.1 - Versão
```
gear --version|-v
```



Esse projeto é feito de coração.
