# 1. Gear\Module

---


O módulo pode estar contido em um Projeto ou ser Standalone.

## Estrutura

A estrutura dos módulos deverá ser assim:

### Configuração Gear

Possuir versão Gear.

### Diretórios que precisam ter permissão de escrita

| Pasta/Arquivo | Descrição | Web | Cli | Ignore |
| : -- | --- | --- | --- | --- |
| build/.gitignore | Onde é gravado os resultados da build. | X | X | X |
| data/logs/.gitignore | Onde grava exceptions geradas por GearAdmin. | X | - | X |
| data/cache/configcache/.gitignore | Onde grava o cache da configuração dos módulos. | X | - | X | 
| data/DoctrineModule/cache/.gitignore | Onde grava as consultas do DoctrineModule. | X | - | X |
| data/DoctrineORMModule/Proxy/.gitignore | Onde grava os proxys do DoctrineORMModule. | X | - | X |
| data/session/.gitignore | Onde grava as sessões do módulo. | X | - | X | 
| data/migrations | Onde grava as migrations para banco de dados. | X | X | - |
| node_modules | Onde grava os módulos de teste frontend. | X | - | X | 


### Arquivos necessários

| Script | Web | Cli |
|:--|---|---|
| deploy-development.sh | X | X |
| deploy-testing.sh | X | X |
| data/config.json | X | - |
| schema/module.json | X | - |
| public/js/spec/end2end.conf.js | X | - |
| public/js/spec/karma.conf.js | X | - |
| test/unit.suite.yml | X | X |
| phinx.yml | X | X |
| codeception.yml | X | X |
| mkdocs.yml | X | X |
| phpdox.xml | X | X |
| README.md | X | X |
| docs/index.md | X | X |
| mkdocs.md | X | X |
| test/phpmd.xml | X | X |
| test/phpcs-docs.xml | X | X |
| test/phpunit-benchmark.xml | X | X |
| test/phpunit-coverage-benchmark.xml | X | X |

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

### Gulpfile


| Ação |
|:--|
| Optimize CSS |
| Optimize JS Login |
| Optimize JS Admin |


### Build 

#### ant-basic.xml

1. [ ***REMOVED*** - clean - Limpa as pastas
1. [ ***REMOVED*** - prepare - Cria as pastas
1. [ ***REMOVED*** - set-vendor - Descobre onde está a pasta vendor
    1. [ ***REMOVED*** - is-as-vendor
    1. [ ***REMOVED*** - is-as-module
    1. [ ***REMOVED*** - is-as-project
    1. [ ***REMOVED*** - as-vendor 
    1. [ ***REMOVED*** - as-module
    1. [ ***REMOVED*** - as-project
1. [ ***REMOVED*** - db-load
1. [ ***REMOVED*** - cache-load
1. [ ***REMOVED*** - build-helper

#### ant-dev.xml


#### ant-ci.xml


#### Build Web

1. [ ***REMOVED*** - build
1. [ ***REMOVED*** - file-php
1. [ ***REMOVED*** - file-js
1. [ ***REMOVED*** - dev
1. [ ***REMOVED*** - benchmark
1. [ ***REMOVED*** - acceptance
1. [ ***REMOVED*** - measure
    1. [ ***REMOVED*** - prepare
    1. [ ***REMOVED*** - set-vendor
    1. [ ***REMOVED*** - parallel-lint
    1. [ ***REMOVED*** - unit-coverage-ci 
    1. [ ***REMOVED*** - phploc-ci 
    1. [ ***REMOVED*** - pdepend 
    1. [ ***REMOVED*** - phpdox 
    1. [ ***REMOVED*** - publish
1. [ ***REMOVED*** - namespace
    1. [ ***REMOVED*** unit-coverage-namespace
    1. [ ***REMOVED*** phpcs-namespace
    1. [ ***REMOVED*** phpcpd-namespace
    1. [ ***REMOVED*** phpmd-namespace


#### Build Cli



#### Target

1. [ ***REMOVED*** - phpcs-dev | dev |
1. [ ***REMOVED*** - phpmd-dev | dev |
1. [ ***REMOVED*** - phpcpd-dev | dev |
1. [ ***REMOVED*** - unit-dev | dev |
1. [ ***REMOVED*** - karma-dev | dev |
1. [ ***REMOVED*** - jshint | acceptance |
1. [ ***REMOVED*** - phpcs | acceptance |
1. [ ***REMOVED*** - phpmd | acceptance |
1. [ ***REMOVED*** - phpcpd | acceptance |
1. [ ***REMOVED*** - karma-group | acceptance |
1. [ ***REMOVED*** - unit-group | acceptance |
1. [ ***REMOVED*** - protractor-group | acceptance |
1. [ ***REMOVED*** - phpmd-file | file-php |
1. [ ***REMOVED*** - phpcs-file | file-php |
1. [ ***REMOVED*** - phpcpd-file | file-php |
1. [ ***REMOVED*** - jshint-file | file-js |
1. [ ***REMOVED*** - phpunit-benchmark | benchmark |
1. [ ***REMOVED*** - parallel-lint | build |
1. [ ***REMOVED*** - unit-ci | build |
1. [ ***REMOVED*** - karma-ci | build |
1. [ ***REMOVED*** - jshint-ci | build |
1. [ ***REMOVED*** - phpcs-ci | build |
1. [ ***REMOVED*** - phpmd-ci | build |
1. [ ***REMOVED*** - phpcpd-ci | build |
1. [ ***REMOVED*** - protractor | build |
1. [ ***REMOVED*** - phpdox | build | 
1. [ ***REMOVED*** - pdepend | build |
1. [ ***REMOVED*** - phploc-ci | build |
1. [ ***REMOVED*** - publish | build |



##### Exclusívos Web
 
    





#### Build de processos

| Target | Web | Cli |
|:--|:--|:--|
| build(1) | clean, prepare, parallel-lint, jshint-ci, karma-ci, protractor-ci, phpcs-ci, phpmd-ci, phpcpd-ci, unit-ci, pdepend, phploc-ci, phpdox, publish | clean, prepare, parallel-lint, phpcs-ci, phpmd-ci, phpcpd-ci, unit-ci, pdepend, phploc-ci, phpdox
| file-php(2) | phpcs-file, phpmd-file, phpcpd-file | = |
| file-js(3) | jshint-file | - | 
| dev(4) | phpcs-dev, phpmd-dev, phpcpd-dev, unit-dev, karma-dev | phpcs-dev, phpmd-dev, phpcpd-dev |
| benchmark(5) | phpunit-benchmark | = | 
| acceptance(6) | jshint, karma, phpcs, phpmd, phpcpd, unit-group, protractor-group | phpcs, phpmd, phpcpd, unit-group |








## Comandos

### 1. Criar um módulo em um projeto

---

    gear module create <module> [--build=***REMOVED*** [--layout=***REMOVED*** [--no-layout***REMOVED***



### 2. Criar um módulo separado

---

    gear module-as-project create <module> <basepath>
    
    
### 3. Deletar um módulo já criado    

---
    
    gear module delete <module>
    
    
### 4. Carregar um módulo para ser utilizado.

---

    gear module load <module> [--before=***REMOVED*** [--after=***REMOVED***
    
### 5. Desativar um módulo para não ser mais utilizado

---

    gear module unload <module>    
   
### 6. Criar Entidades

---

    gear module entities <module>

### 7. Criar Entidade

---

    gear module entity <module> --entity=

### 8. Diagnóstico

---

    gear module diagnostic <module> [<basepath>***REMOVED*** [--cli***REMOVED***


### 9. Upgrade

---

    gear module upgrade <module> [--Y***REMOVED***

### 10. Dump Autoload

---

    gear module dump-autoload <module>

### 11. Fixture

---

    gear module fixture <module> [--append***REMOVED*** [--reset-increment***REMOVED*** 
    


## Dependente/Standalone

Módulos standalone são produzidos para serem utilizados por N projetos.

Todos módulos tendem a ter cultura standalone, sendo os projetos uma mistura de N desses projetos.

O interessante é apenas configurar os módulos em nível de projeto.

Todos testes devem ser feitos nos módulos standalone.

Para criar módulos enxutos, será possível criar os módulos de 2 formas diferentes:

1 - Inclusivo. Adiciona o módulo mais básico sem nenhuma ação e escolhe as features que quer usar.

2 - Exclusivo. Adiciona o módulo com todas opções possíveis e escolhe se quer remover alguma.


    