# Gear

Gerador de sistemas.
Automatizador de processos.

## Processo Básico

O processo básico do Gear é criar um sistema e colocar direto em produção, com todo processo realizado e testado por integração contínua.


Para isso, é necessário gerar o sistema e automatizar os processos.


## Piber Network - Gear - Module


> [Voltar***REMOVED***(https://bitbucket.org/mauriciopiber/pibernetwork-docs/src/HEAD/README.md)

> GearModule Reune todas tarefas relacionadas a criação de módulos.

> O Gear é um criador de módulos, que teve que assumir outras responsábilidades, mas todas focadas na produção em tempo recorde de módulos zf3.


## Table of contents

  1. [Gear\Module***REMOVED***(#module)
  1. [Roadmap***REMOVED***(#roadmap)
  1. [GearJson\Schema***REMOVED***(#schema)
  1. [Gear\Module\Constructor***REMOVED***(#constructor)
  1. [Gear\Module\Mvc***REMOVED***(#mvc)
  1. [Gear\Module\Columns***REMOVED***(#column)
  1. [Gear\Module\Table***REMOVED***(#table)
  1. [Gear\Module\UserType***REMOVED***(#usertype)


## Module




Cria Módulo localizado na pasta "Module" de um projeto.

    gear module create <module> [--build=***REMOVED*** [--layout=***REMOVED*** [--no-layout***REMOVED*** 
    
Cria Módulo que funciona como projeto e pode ser distribuído entre vários projetos.    
    
    gear module-as-project create <module> <basepath>
    
Deprecated - Cria Módulo Angular.    
    gear module create angular <module>     
    
Deprecated - Cria Módulo com estrutura mínima para começar o desenvolvimento.    
    
    gear module create <module> --light [--ci***REMOVED*** [--build=***REMOVED*** [--doctrine***REMOVED*** [--doctrine-fixture***REMOVED*** [--unit***REMOVED*** [--codeception***REMOVED*** [--gear***REMOVED***
    
Deleta módulo criado.    

    gear module delete <module>
    
Carrega um novo módulo no application.config.php    

    gear module load <module> [--before=***REMOVED*** [--after=***REMOVED***    
    
Descarrega um novo do application.config.php    

    gear module unload <module>

Testa um módulo

    gear module build <module> [--trigger=***REMOVED*** [--domain=***REMOVED*** 

Cria todas entidades possíveis do banco para um determinado Módulo.

    gear module entities <module>    
    
Cria uma entidade para um determinado Módulo    
    
    gear module entity <module> --entity=    
    
Faz uma varredura e atualiza o módulo para última versão que está sendo utilizada no Gear

    gear module upgrade <module> [--Y***REMOVED***    

Adicionar o módulo ao vendor/autoload/namespace.php para utilizar o namespace de testes.

    gear module dump-autoload <module>    
    
    gear module fixture <module> [--append***REMOVED*** [--reset-increment***REMOVED***    

### Gear Module


## Roadmap 


v1.0.0 - 29/02/2015



v1.1.0 - 31/04/2016


## GEAR/PIBERNETWORK Criar Módulos.

O módulo pode estar contido em um Projeto ou ser Standalone.

## Standalone

Módulos standalone são produzidos para serem utilizados por N projetos.

Todos módulos tendem a ter cultura standalone, sendo os projetos uma mistura de N desses projetos.

O interessante é apenas configurar os módulos em nível de projeto.

Todos testes devem ser feitos nos módulos standalone.

Para criar módulos enxutos, será possível criar os módulos de 2 formas diferentes:

1 - Inclusivo. Adiciona o módulo mais básico sem nenhuma ação e escolhe as features que quer usar.

2 - Exclusivo. Adiciona o módulo com todas opções possíveis e escolhe se quer remover alguma.

## Schema 

Estrutura criada para salvar o estado atual do módulo.

    {
    	"Module": { // Nome do Módulo
    		"app": [{ //Recursos de Front-End
    			"name": "", //Nome
    			"type": "", //Tipo, [Controller|Service|Filter|Directive***REMOVED***
    			"dependency": "", //Dependencia, Type+Nome
    			"db": "", // DB associado
    			"namespace": "" //Namespace onde será salvo.
    		}***REMOVED***,
    		"src": [{ //Recursos Back-end
    			"name": "", //Nome 
    			"type": "", //Tipo, pode ser Repository, Service, Filter, Form, Fixture, ViewHelper, ControllerHelper, Entity;
    			"dependency": "", //Dependência, que deve ser namespace + nome
    			"db": "", //DB associado
    			"namespace": "", //Namespace que será utilizado no arquivo.
    			"extends": "", //Recurso que será pai 
    			"abstract": "", //Boolean se a classe deve ser definida abstrata ou não.
    			"service": "",//Pode ser "factories" ou "invokables".
    			"template": ""//Estrutura a ser utilizada para gerar 
    		}***REMOVED***,
    		"controller": [{//Recursos do MVC para criar telas.
    			"type": "", //Tipo, pode ser Console, Action e Rest.
    			"namespace": "",//Namespace que será utilizado no arquivo.
    			"name": "", //Nome que será utilizado no arquivo.
    			"object": "", @DEPRECATED
    			"service": "", //Serviço, pode ser "factories" ou "invokables"
    			"actions": [{//Ações do Controllador
    				"name": "",//Nome da Ação
    				"role": "",//Permissão da Ação
    				"route": "",//URL que será utilizada na ação
    				"db": "",//Banco de dados utilizado
    				"dependency": ""//Quais dependências (app/src) são necessárias
    			}***REMOVED***,
    			"extends": "", //Recurso que será pai
    			"db": "", //Banco de dados utilizado
    			"columns": [***REMOVED*** //Colunas que deverão ser especializadas.
    		}***REMOVED***,
    		"db": [{//Cria todo MVC para determinada tabela.
    			"table": "", //Nome da Tabela no banco.
    			"columns": [***REMOVED***, //Especialidade das colunas.
    			"user": "" //Espécie de acesso que deve utilizar para criar.
    		}***REMOVED***
    	}
    }






## Construtor.

## Mvc

o Mvc é utilizado pelos construtores, direta ou indiretamente.
o Mvc deve utilizar uma estrutura básica e ser igual para todas classes.

| Varchar                               | Date               | Datetime                                               
| ------------------------------------------------- |----------------------| ---------------------------------------------------------|
| Varchar | Email | PasswordVerify | UploadImage | UniqueId | Date | DatePtBr | ---------------------------------------------------------|

| Construct                                               | Column               | Template                                                 |
| ------------------------------------------------- |----------------------| ---------------------------------------------------------|
|  |         | |




    1. Controller
    2. Service
    3. Repository
    4. Factory
    5. Entity
    6. Form
    7. Filter
    8. Fixture
    9. View

## Constructor

    1. Mvc [Old Db***REMOVED***
    2. Controller/Action
        1. Controller Mvc.
        2. Action Mvc.
        3. Controller Console.
        4. Action Console.
        5. Controller Rest.
        6. Action Rest.
    3. Src
        1. Service.
        2. Repository.
        3. Factory.
        4. Entity.
        5. Form.
        6. Filter.
        7. Fixture.
    4. App
        1. Controller
        2. Service
    5. View
    6. Test


## Column




## Criar Nova Coluna.

Colunas é a forma mais simples para expandir o Gear. São adicionados novos formatos de colunas para agilizar o desenvolvimento de telas de cadastro.

### Estrutura Teórica

As colunas são divididas entre "Tipo" e "Especialidade". 
O Tipo é referente ao tipo de coluna utilizado no banco de dados.
A especialidade é referente à customização relacionada à coluna.


### Quais são as estruturas que dependem das Colunas? Quais são as peças que precisam de customização referente a colunas?


| Mvc                                               | Column               | Template                                                 |
| ------------------------------------------------- |----------------------| ---------------------------------------------------------|
| Gear\Mvc\View\ViewService->createFormElements()                   | getViewFormElement()             | template/module/columns/abstract/view/form-element.phtml  |
| Gear\Mvc\View\ViewService->createActionEdit()                     | getViewFormElement()             | template/module/columns/abstract/view/form-element.phtml  |
| Gear\Mvc\View\ViewService->getListRow()                           | getListRowElements()             | template/module/columns/abstract/view/table-element.phtml |
| Gear\Mvc\View\ViewService->getViewValues()                        | getViewData()                    | template/module/columns/abstract/view/table-element.phtml |
| Gear\Mvc\View\ViewService->getSearchElements()                    | getSearchViewElement()           | template/module/columns/abstract/view/table-element.phtml |
| Gear\Mvc\Controller\ControllerService->getColumnsSpecifications() | getControllerUse()               | | 
| Gear\Mvc\Controller\ControllerService->getColumnsSpecifications() | getControllerAttribute()         | |
| Gear\Mvc\Controller\ControllerService->getColumnsSpecifications() | getControllerValidationFail()    | |
| Gear\Mvc\Controller\ControllerService->getColumnsSpecifications() | getControllerCreateBeforeView()  | |
| Gear\Mvc\Controller\ControllerService->getColumnsSpecifications() | getControllerDeclareVar()        | |
| Gear\Mvc\Controller\ControllerService->getColumnsSpecifications() | getControllerEditBeforeView()    | |
| Gear\Mvc\Controller\ControllerService->getColumnsSpecifications() | getControllerArrayView()         | |
| Gear\Mvc\Controller\ControllerService->setPreValidateFromColumns()| getControllerPreValidate()       | |
| Gear\Mvc\Controller\ControllerService->setPreShowFromColumns()    | getControllerPreShow()           | |
| Gear\Mvc\Controller\ControllerTestService->introspectFromTable()  | getControllerUnitTest()          | |
| Gear\Mvc\Filter\FilterService->getColumnsSpecifications()         | getFilterFormElement()           | |
| Gear\Mvc\Filter\FilterTestService->getTestColumns()               | getFilterTest()                  | |
| Gear\Mvc\Fixture\FixtureService->getEntityFixture()               | getFixtureUser()                 | |
| Gear\Mvc\Fixture\FixtureService->getEntityFixture()               | getFixtureData()                 | |
| Gear\Mvc\Fixture\FixtureService->getColumnsSpecifications()       | getFixtureGetFixture()           | |
| Gear\Mvc\Fixture\FixtureService->getColumnsSpecifications()       | getFixtureUse()                  | |
| Gear\Mvc\Fixture\FixtureService->getColumnsSpecifications()       | getFixtureAttribute()            | |
| Gear\Mvc\Form\FormService->getFormInputValues()                   | getFormElement()                 | |
| Gear\Mvc\Search\SearchService->introspectFromTable()              | getSearchFormElement()           | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getServiceInsertBody()           | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getServiceInsertSuccess()        | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getServiceUpdateBody()           | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getServiceUpdateSuccess()        | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getServiceDeleteBody()           | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getUse()                         | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getAttribute()                   | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getServiceUse()                  | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getServiceAttribute()            | |
| Gear\Mvc\Service\ServiceService->getColumnsSpecifications()       | getServiceFunctions()            | |




#### Gear\Mvc\Form\FormService

#### Gear\Mvc\Form\FilterService

#### Gear\Mvc\Filter\FilterTestService

#### Gear\Mvc\Repository\RepositoryTestService

#### Gear\Mvc\Service\ServiceTestService

#### Gear\Mvc\Controller\ControllerService



#### Gear\Mvc\Controller\ControllerTestService


filterElement()
filterUniqueElement()
getFilterFormElement()
getFixture
getFixtureData
getFixtureDatabase
getFixtureDefault()
getFormElement()
getIdFormElement()
getInsertArrayByColumn()
getInsertAssertByColumn()
getInsertSelectByColumn()
getUpdateArrayByColumn()
getUpdateAssertByColumn()
getViewColumnLayout()
getViewData()
getViewFormElement()
getViewListRowElement()

## Column - Colunas já desenvolvidas

    1. Varchar
        1. UploadImage
        2. PasswordVerify
        3. Email
    2. Text
        1. Html
    3. Decimal
        1. MoneyPtBr
        2. MoneyEnUs
    4. Date
        1. DatePtBr
        2. DateEnUs
    5. DateTime
        1. DateTimePtBr
        2. DateTimeEnUs


##### Varchar - Upload Image

1. Config > Adiciona um ítem nas configurações de upload.
1. Form > Troca o Input Text por um Input File Upload.
1. Filter > Adiciona um renamefileupload 



## UserType

    1. All
    2. Low-Strict
    3. Strict
    

## Table

    1. UploadImage
    
A tabela upload_image possui módulo próprio. Todas entidades para admin que pretenderem utilizar imagens podem utilizar essa tabela.

O Gear verifica a tabela upload_image, e se encontrar relação entre.
