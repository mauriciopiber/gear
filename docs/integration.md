# Testes de Integração.


O teste de integração é o ponto onde o Gear se completa a sí mesmo.
É impossível testar todo Gear por meio de Testes unitários, então é necessário testes de Integração.

Existe toda uma base de scripts criada exatamente para facilitar esse trabalho.



# Integração -> Main

É a integração mais absoluta do Sistema. São os testes que serão rodados antes do lançamento de uma nova versão.
Eles devem compreender todo alcance técnico do sistema.




# Integração - Major

São os testes responsáveis por funcionalidades absolutas, são testes que compreendem mais de uma funcionalidade e a harmonia entre os diversos componentes.



# Integração - Minor

São os testes responsáveis por testar funcionalidades específicas, sem relação à outras funcionalidades, para testar o comportamento isolado de determinado componente.


Testes minor relacionado á Controller.

1. [ ***REMOVED*** Controller -> Web
1. [ ***REMOVED*** Controller -> Console


Testes minor relacionado à Src.

1. [ ***REMOVED*** Entity - Db
1. [ ***REMOVED*** Fixture - Db
1. [ ***REMOVED*** Service
    1. [ ***REMOVED*** Src
    1. [ ***REMOVED*** Db
1. [ ***REMOVED*** Repository
    1. [ ***REMOVED*** Src
    1. [ ***REMOVED*** Db
1. [ ***REMOVED*** Trait
    1. [ ***REMOVED*** Src
    1. [ ***REMOVED*** Db
1. [ ***REMOVED*** Factory
    1. [ ***REMOVED*** Src
    1. [ ***REMOVED*** Db
1. [ ***REMOVED*** Form
    1. [ ***REMOVED*** Src
    1. [ ***REMOVED*** Db
1. [ ***REMOVED*** Filter
    1. [ ***REMOVED*** Src
    1. [ ***REMOVED*** Db

---

## SrcTests

1. src
  1. src-form
  1. src-filter
  1. src-service
  1. src-repository
  1. src-viewhelper
  1. src-controllerplugin
  1. src-valueobject
  1. src-interface


### src-interface

1. [ ***REMOVED*** Create Interface
1. [ ***REMOVED*** Create Interface with custom namespace.
1. [ ***REMOVED*** Create Interface with dependency.
1. [ ***REMOVED*** Create Interface with dependencies.
1. [ ***REMOVED*** Create Interface with dependency and namespace.
1. [ ***REMOVED*** Create Interface with dependencies and namespace.
1. [ ***REMOVED*** Create Interface with extends interface
1. [ ***REMOVED*** Create interface with extends custom interface.
1. [ ***REMOVED*** Create interface with extends custom interface with namespace. 


### src-repository

1. [ ***REMOVED*** Create Repository
1. [ ***REMOVED*** Create Repository with custom namespace
1. [ ***REMOVED*** Create Repository with dependency.
1. [ ***REMOVED*** Create Repository with dependencies.
1. [ ***REMOVED*** Create Repository with extends a custom repository.
1. [ ***REMOVED*** Create Repository abstract.
1. [ ***REMOVED*** Create Repository in invokables.
1. [ ***REMOVED*** Create Repository with implementes Interface.
1. [ ***REMOVED*** Create Repository with implementes Interface with custom namespace.
1. [ ***REMOVED*** Create Repository with custom namespace with implementes Interface.
1. [ ***REMOVED*** Create Repository with custom namespace with implementes Interface with custom namespace.

SrcMvcTests

MvcTests

ControllerTests 


ModuleTests
DatabaseTests
ProjectTests 

DiagnosticTests


