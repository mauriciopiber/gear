# Componente Gear\Module\Columns


Tabela de componentes que são utilizados para Criar o Mvc.

## Lista de classes Mvc que usam Colunas de alguma forma.


| Classe | 
|:--| 
|Gear\Mvc\Fixture\FixtureService|
|Gear\Mvc\Spec\Feature\Feature|
|Gear\Mvc\Spec\Step\Step|
|Gear\Mvc\View\ViewService|
|Gear\Mvc\Controller\ControllerTestService|
|Gear\Mvc\Controller\ControllerService|
|Gear\Mvc\Form\FormService|
|Gear\Mvc\Filter\FilterTestService|
|Gear\Mvc\Filter\FilterService|
|Gear\Mvc\Service\ServiceTestService|
|Gear\Mvc\Service\ServiceService|
|Gear\Mvc\Repository\MappingService|
|Gear\Mvc\Repository\RepositoryTestService|
|Gear\Mvc\Entity\EntityServiceTest|


## Lista de comandos criados pelas Colunas

Regras:

1. getValue[****REMOVED*** só retorna o valor baseado na regra da coluna, sem utilizar a ColumnObject.


| Comando | Descrição |
|:--|:--|
| getValueView() | Gera o formato de dados utilizado em tarefas de View |
| getValueDatabase() | Gera o formato de dados utilizado em tarefas de Banco de dados |
| getIntegrationActionSendKeys() | Gera os envios do form em Spec |
| getIntegrationActionExpectValue () | Gera a verificação do form em Spec |
| getIntegrationActionList() | Gera a verificação da listagem em Spec |
| getIntegrationActionView() | Gera a verificação da visualização em Spec |
| **getFixture()** | **Gera o formato utilizado nos testes Acceptance e Functional** |
| **getFixtureDatabase()** | **Função que não é mais utilizada** |
| getViewData() | Retorna o template da View de Visualização para a Coluna |
| getViewColumnLayout() | Cria o template da View de Visualização para a Coluna |
| getBaseMessage() | **Remover** |
| getFixtureData() | Utilizado para criar os valores na Fixture |
| **getFixtureDefault()** | **Utilizado em testes de Acceptance/Functional** |
| getInsertArrayByColumn() | **Pega os valores para serem inseridos nos testes** |
| getInsertSelectByColumn() | **Pega os valores usados para selecionar nos testes** |
| getInsertAssertByColumn() | **Pega os valores usados para verificar ok no testes** |
| getFormElement() | Gera o Form |
| getViewFormElement() | Gera a exibição do Form na View |
| filterUniqueElement() | Gera o filtro para colunas Únicas |
| filterElement() | Gera o filtro para colunas normais |
| getFilterFormElement() | Gera o filtro baseado na coluna Unique para Filter |
| getViewListRowElement() | Gera a exibição da Listagem na View |


## Lista da relação entre Classe Mvc e Classe Column

#### Gear\Mvc\Fixture\FixtureService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getFieldData | **Está implementado fora de columns** | - |
| getEntityFixture | getFixtureData | - |
| getColumnsSpecifications | getImplements | - |  

#### Gear\Mvc\Spec\Feature\Feature

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| buildCreateActionSendKeys | getIntegrationActionSendKeys | Int\PrimaryKey, Varchar\UniqueId |
| buildCreateActionExpectValues | getIntegrationActionExpectValue | Int\PrimaryKey |
| buildListActionCreateAssert | getIntegrationActionList | Varchar\UniqueId, Varchar\PasswordVerify, Varchar\UploadImage, Text\Html, Text\Text |
| buildViewActionCreateAssert | getIntegrationActionView |Int\PrimaryKey, Varchar\UniqueId, Varchar\PasswordVerify |


#### Gear\Mvc\View\ViewService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getListRowElements | getViewListRowElement | Text\Text, Varchar\UploadImage, Varchar\PasswordVerify, Varchar\UniqueId, Int\Checkbox, AbstractCheckbox |
| getViewValues | getViewData | Varchar\PasswordVerify, Varchar\UniqueId |
| createFormElements | getViewFormElement | Varchar\UniqueId, Int\PrimaryKey, AbstractColumn |

#### Gear\Mvc\Controller\ControllerTestService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| introspectFromTable | getControllerUnitTest | - |

#### Gear\Mvc\Controller\ControllerService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getColumnsSpecifications | getControllerUse | - |
| getColumnsSpecifications | getControllerAttribute | - |
| getColumnsSpecifications | getControllerValidationFail | - |
| getColumnsSpecifications | getControllerCreateBeforeView | - |
| getColumnsSpecifications | getControllerDeclareVar | - |
| getColumnsSpecifications | getControllerEditBeforeView | - |
| getColumnsSpecifications | getControllerArrayView | - |


#### Gear\Mvc\Form\FormService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getFormInputValues | getFormElement | Varchar\UniqueId |


#### Gear\Mvc\Filter\FilterTestService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getTestRequiredColumns  | **Está implementado fora de columns** | - |
| getTestColumns | getFilterTest | !method getFilterTest |
| getTestValidReturnTrue  | **Está implementado fora de columns** | - |

#### Gear\Mvc\Filter\FilterService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getFilterValues | getFilterFormElement | Int\Primary |


#### Gear\Mvc\Service\ServiceTestService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getSelectOneByForUnitTest | **Está implementado fora de columns** | - |


#### Gear\Mvc\Service\ServiceService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getColumnsSpecifications | getServiceInsertBody | !interface ServiceAwareInterface |
| getColumnsSpecifications | getServiceInsertSuccess | !interface ServiceAwareInterface |
| getColumnsSpecifications | getServiceUpdateBody | !interface ServiceAwareInterface |
| getColumnsSpecifications | getServiceUpdateSuccess | !interface ServiceAwareInterface |
| getColumnsSpecifications | getServiceDeleteBody | !interface ServiceAwareInterface |
| getColumnsSpecifications | getUse | !interface ServiceAwareInterface |
| getColumnsSpecifications | getAttribute | !interface ServiceAwareInterface |
| getColumnsSpecifications | getServiceUse | !interface ServiceAwareInterface |
| getColumnsSpecifications | getServiceAttribute | !interface ServiceAwareInterface |
| getColumnsSpecifications | getServiceFunctions | !interface ServiceAwareInterface |



#### Gear\Mvc\Repository\MappingService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getRepositoryMapping | **Está implementado fora de columns** | - |

#### Gear\Mvc\Repository\RepositoryTestService

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| setUpOrder | **Está implementado fora de columns** | - |
| setUpOneBy | **Está implementado fora de columns** | - |


#### Gear\Mvc\Entity\EntityServiceTest


| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| getTestSetters | **Está implementado fora de columns** | - |
| getTestGettersNull | **Está implementado fora de columns** | - |
| getProvider |  **Está implementado fora de columns** | - |
| getMocks | **Está implementado fora de columns** | - |
| getParams | **Está implementado fora de columns** | - |


## Todo

1. Dividir as interfaces para evitar código inútil nas colunas.
1. Passar todas operações das colunas para Column, não deixar fixo dentro da classe Mvc.
1. Testar as colunas com código unitário. [Descobrir como***REMOVED***