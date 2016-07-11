# Componente Gear\Module\Columns


Tabela de componentes que são utilizados para Criar o Mvc.


#### Gear\Mvc\Spec\Feature\Feature

| Método que utiliza | Método utilizado | Ignora |
|:--|:--|:--|
| buildCreateActionSendKeys | getIntegrationActionSendKeys | Int\PrimaryKey, Varchar\UniqueId |
| buildCreateActionExpectValues | getIntegrationActionExpectValue | Int\PrimaryKey |
| buildListActionCreateAssert | getIntegrationActionList | Varchar\UniqueId, Varchar\PasswordVerify, Varchar\UploadImage, Text\Html, Text\Text |
| buildViewActionCreateAssert | getIntegrationActionView |Int\PrimaryKey, Varchar\UniqueId, Varchar\PasswordVerify |


#### Gear\Mvc\View\ViewService

#### Gear\Mvc\Controller\ControllerTestService

#### Gear\Mvc\Controller\ControllerService

#### Gear\Mvc\Form\FormTestService

#### Gear\Mvc\Form\FormService



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