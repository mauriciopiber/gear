# Gear\Constructor

## Constructor

O que é possível criar com o Constructor?

    1. Mvc
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
        1. CucumberJS with page, features and steps
        2. Karma 
        3. Phpunit


## Comandos


### 1. Criar Controller

---

    gear module controller create <module> 
      [<basepath>***REMOVED*** 
      --name= 
      [--extends=***REMOVED*** 
      [--type=***REMOVED*** 
      [--namespace=***REMOVED*** 
      [--object=***REMOVED*** 
      [--db=***REMOVED*** 
      [--columns***REMOVED*** 
      [--service=***REMOVED***

### 2. Criar Action em Controller

---

    gear module activity create <module> 
      [<basepath>***REMOVED*** 
      <parent>  
      [--template=***REMOVED*** 
      --name= 
      [--route=***REMOVED*** 
      [--role=***REMOVED*** 
      [--dependency=***REMOVED***

### 3. Criar Teste

---

    gear module test create <module>  [<basepath>***REMOVED*** --suite= --target=
    
### 4. Criar View

---

    gear module view create <module>  [<basepath>***REMOVED*** --target=      

### 5. Criar Mvc Db 

---

    gear module db create <module> [<basepath>***REMOVED*** --table= [--user=***REMOVED*** [--default-role=***REMOVED*** [--columns=***REMOVED***
    
    
### 6. Criar Angular

---
   
    gear module app create <module> [<basepath>***REMOVED*** --type= --name= [--namespace=***REMOVED*** [--db=***REMOVED*** [--dependency=***REMOVED***     
    
### 7. Criar Src    

---

    gear module src create <module> 
      [<basepath>***REMOVED*** 
      --type= 
      --name= 
      [--namespace=***REMOVED*** 
      [--service=***REMOVED*** 
      [--template=***REMOVED*** 
      [--abstract***REMOVED*** 
      [--dependency==***REMOVED*** 
      [--extends=***REMOVED*** 
      [--db=***REMOVED*** 
      [--columns=***REMOVED***
      
### 8. Deletar Src

---

    gear module src delete <module> [<basepath>***REMOVED*** --name= --type= [--namespace=***REMOVED*** 
    
### 9. Criar Src Free

---

    gear module src create <module> --name= --namespace= [--dependency==***REMOVED*** [--extends=***REMOVED***


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

## Comandos