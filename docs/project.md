# Gear\Project

## Estrutura

A estrutura dos módulos deverá ser assim:

### Configuração Gear

Possuir versão Gear.

### Diretórios que precisam ter permissão de escrita

| Pasta/Arquivo | Web |
| : -- | --- | --- |
| build/.gitignore | X | 
| data/logs/.gitignore | X |
| data/cache/configcache/.gitignore | X | 
| data/DoctrineModule/cache/.gitignore | X |
| data/DoctrineORMModule/Proxy/.gitignore | X |
| data/session/.gitignore | X | 
| data/migrations | X |


### Composer

| Package | Version | Group | Web | Cli |
| :-- | --- | --- | --- | --- |
| zendframework/zendframework| ^2.5.0 | Framework | X | X |
| zendframework/zend-mvc| ~2.6.0 | Framework MVC | X | X |
| doctrine/doctrine-module| 0.8.* | Doctrine | X | X |
| doctrine/doctrine-orm-module| 0.8.* | Doctrine | X | X |
| zf-commons/zfc-user| 1.4.3 | Authentication | X | X
| robmorgan/phinx| * | Migration | X | X |
| sebastian/phpcpd| ^2.0.2 | Ci | X | X |
| sebastian/phpdcd| ^1.0.2 | Ci | X | X |
| phpunit/phpunit| ^4.8.19 | Ci | X | X |
| phploc/phploc| ^2.1.5 | Ci | X | X |
| codeception/codeception| ^2.1.4 | Ci | X | X |
| squizlabs/php_codesniffer| ^2.0.0 | Ci | X | X |
| phpmd/phpmd| ^2.3.2 | Ci | X | X |
| jakub-onderka/php-parallel-lint| ^0.9 | Ci | X | X |
| pdepend/pdepend| ^2.0.3 | Ci | X | X |
| mauriciopiber/gear-base| ^0.2.0 | Base | X | X |
| mauriciopiber/gear-json| ^0.2.0 | Base | X | X |
| mauriciopiber/gear-acl| ^0.2.0 | Base Web | X | X |
| mauriciopiber/gear-admin| ^0.2.0 | Base Web | X | X |
| mauriciopiber/gear-image| ^0.2.0 | Base Web | X | X |
| mauriciopiber/gear-deploy| ^0.2.0 | Base | X | X |
| mauriciopiber/gear-jenkins| ^0.2.0 | Base | X | X |
| mauriciopiber/gear-version| ^0.2.0 | Base | X | X |
| mauriciopiber/gear| ^0.2.0 | Generator | X | X |
| johnkary/phpunit-speedtrap | ^1.0 | Benchmark | X | X |
| atrapalo/phpunit-memory-and-time-usage-listener| dev-master | Benchmark | X | X |

### Npm

| Package | Version | Group |
|:--|:--|:--|
| bower | ~1.6| Package Manager |
| chai | ^3.5.0| Ci |
| chai-as-promised | ^5.3.0| Ci |
| cucumber | ^0.10.2| Ci |
| cucumber-html-report | ^0.2.5| Ci |
| cucumber-junit | ^1.5.0| Ci |
| cucumber-protractor-report | ^1.0.0| Ci |
| cucumberjs-junitxml | 0.0.12| Ci |
| gulp | ^3.0.0| Assets |
| gulp-concat | ^2.6.0| Assets |
| gulp-cssmin | ^0.1.7| Assets |
| gulp-if | ~2.0| Assets |
| gulp-rename | ^1.2.2| Assets |
| gulp-shell | ~0.5| Assets |
| gulp-size | ^2.0.0| Assets |
| gulp-strip-css-comments | ^1.2.0| Assets |
| gulp-uglify | ^1.5.1| Assets |
| gulp-util | ~3.0| Assets |
| gulp-watch | ^4.0.3| Assets |
| jasmine | ~2.3| Ci |
| jasmine-core | ^2.3.4| Ci |
| jasmine-reporters | ~2.0.0| Ci |
| jscpd | ^0.6.1| Ci |
| jshint | ~2.8| Ci |
| jshint-checkstyle-file-reporter | *| Ci |
| junit | ~0.8| Ci |
| karma | ~0.13| Ci |
| karma-cli | ~0.1| Ci |
| karma-coverage | ^1.0.0| Ci |
| karma-jasmine | ^0.3.6| Ci |
| karma-junit-reporter | ^0.3.8| Ci |
| karma-ng-html2js-preprocessor | ~0.2| Ci |
| karma-phantomjs-launcher | ^0.2.1| Ci |
| memcached | ^2.2.1| Ci |
| mysql | ^2.10.2| Ci |
| phantomjs | ^1.9.18| Ci |
| protractor | ^3.0.0| Ci |
| protractor-cucumber-framework | ^0.5.0| Ci  |
| protractor-cucumber-junit | ^1.1.3| Ci  |
| protractor-http-mock | ^0.2.0| Ci |
| q | latest| Ci |
| require-dir | ~0.3| Assets |
| run-sequence | ~1.0| Assets |
| yargs | ~3.0" | Assets |


### Build 

#### Funções básicas

| Target | Descrição |
|:--|:--|
| clean | Limpa as pastas |
| prepare | Cria as pastas |
| set-vendor | Descobre onde está a pasta vendor |
| isRunningAsVendor | |
| isRunningAsModule | |
| isRunningAsProject | |
| check.runningAsVendor | | 
| check.runningAsModule | |
| check.runningAsProject | |
| db.load | |
| cache.load | |

#### Build de processos

| Target | Web | Cli |
|:--|:--|:--|
| build(1) | clean, prepare, parallel-lint, jshint-ci, karma-ci, protractor-ci, phpcs-ci, phpmd-ci, phpcpd-ci, unit-ci, pdepend, phploc-ci, phpdox, publish | clean, prepare, parallel-lint, phpcs-ci, phpmd-ci, phpcpd-ci, unit-ci, pdepend, phploc-ci, phpdox
| file-php(2) | phpcs-file, phpmd-file, phpcpd-file | = |
| file-js(3) | jshint-file | - | 
| dev(4) | phpcs-dev, phpmd-dev, phpcpd-dev, unit-dev, karma-dev | phpcs-dev, phpmd-dev, phpcpd-dev |
| benchmark(5) | phpunit-benchmark | = | 
| acceptance(6) | jshint, karma, phpcs, phpmd, phpcpd, unit-group, protractor-group | phpcs, phpmd, phpcpd, unit-group |


#### Tarefas 

| Target | Used By | Depends |
|:--|:--|
| phpcs-dev | dev |
| phpmd-dev | dev |
| phpcpd-dev | dev |
| unit-dev | dev |
| karma-dev | dev |
| jshint | acceptance | 
| phpcs | acceptance |
| phpmd | acceptance |
| phpcpd | acceptance |
| karma-group | acceptance |
| unit-group | acceptance |
| protractor-group | acceptance |
| phpmd-file | file-php |
| phpcs-file | file-php |
| phpcpd-file | file-php |
| jshint-file | file-js |
| phpunit-benchmark | benchmark |
| parallel-lint | build |
| unit-ci | build |
| karma-ci | build |
| jshint-ci | build |
| phpcs-ci | build |
| phpmd-ci | build |
| phpcpd-ci | build |
| protractor | build |
| phpdox | build | 
| pdepend | build |
| phploc-ci | build |
| publish | build |

---



### Scripts para agilizar o trabalho interno

| Script | Web |
|:--|---|---|
| deploy-development.sh | X |
| deploy-staging.sh | X |
| deploy-testing.sh | X |
| deploy-production.sh | X | 

### Gulpfile


| Ação |
|:--|
| Optimize CSS |
| Optimize JS Login |
| Optimize JS Admin |


#### Arquivos necessários para funcionar corretamente que não são naturais ao Zend Framework

| Arquivo | 
|:-- |
| data/config.json |
| schema/module.json |
| test/end2end.conf.js |
| test/karma.conf.js |
| test/unit.suite.yml |
| test/phpunit-benchmark.xml
| phinx.yml |
| codeception.yml |
| mkdocs.yml |
| phpdox.xml |

---

## Comandos

### 1. Criar Projeto

---

    gear project create <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED*** --database= --username= --password= [--basepath=***REMOVED***
    
### 2. Deletar Projeto

---

    gear project delete <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED*** --database= [--basepath=***REMOVED***
    
### 3. Fazer o Upgrade 

---

    gear project upgrade [--Y***REMOVED***
    
### 4. Diagnosticar erros

---

    gear project diagnostic
    
### 5. Inserir Fixtures no banco

---
 
    gear project fixture [--append***REMOVED*** [--reset-autoincrement***REMOVED***

### 6. Criar novo arquivo config

---

    gear project config --host= --dbname=  --username= --password= --environment= --dbms=
    
### 7. Criar arquivo global de configuração   

---
    
    gear project global --host= --dbname=  --dbms= --environment= 
    
### 8. Criar arquivo local de configuração

---
    
    gear project local --username= --password= 

### 9. Criar uma entrada nfs e reiniciar nfs-kernel-server

---
    
    gear project nfs
    
### 10. Criar virtual host para acessar pasta public

---
    
    gear project virtual-host <environment>
    
### 11. Adicionar projeto ao Git.

---
    
    gear project git <git>
    
### 12. Adicionar ao autoload do composer

---
    
    gear project dump-autoload