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




## Tests

* [ ***REMOVED*** **[1***REMOVED***** project
* [ ***REMOVED*** **[2***REMOVED***** module
    * [ ***REMOVED*** **[2.1***REMOVED***** module-cli
    * [ ***REMOVED*** **[2.1***REMOVED***** module-web    
* [ ***REMOVED*** **[3***REMOVED***** mvc
* [ ***REMOVED*** **[4***REMOVED***** controller 
    * [ ***REMOVED*** controller-web [![Build Status***REMOVED***(http://192.168.1.100:8080/job/pbr-controller-web/job/master/badge/icon)***REMOVED***(http://192.168.1.100:8080/job/pbr-controller-web/job/master/)
    * [ ***REMOVED*** controller-console [![Build Status***REMOVED***(http://192.168.1.100:8080/job/pbr-controller-console/job/master/badge/icon)***REMOVED***(http://192.168.1.100:8080/job/pbr-controller-console/job/master/)
    * [ ***REMOVED*** controller-mvc [![Build Status***REMOVED***(http://192.168.1.100:8080/job/pbr-controller-mvc/job/master/badge/icon)***REMOVED***(http://192.168.1.100:8080/job/pbr-controller-mvc/job/master/)
* [ ***REMOVED*** **[5***REMOVED***** src [![Build Status***REMOVED***(http://192.168.1.100:8080/job/pbr-src/job/master/badge/icon)***REMOVED***(http://192.168.1.100:8080/job/pbr-src/job/master/)
    * [ ***REMOVED*** **[5.1***REMOVED***** src-interface [Module PbrSrcInterface***REMOVED*** 
        * [X***REMOVED*** Create Interface
        * [ ***REMOVED*** Create Interface with custom namespace.
        * [ ***REMOVED*** Create Interface with dependency.
        * [ ***REMOVED*** Create Interface with dependencies.
        * [ ***REMOVED*** Create Interface with dependency and namespace.
        * [ ***REMOVED*** Create Interface with dependencies and namespace.
        * [ ***REMOVED*** Create Interface with extends interface
        * [ ***REMOVED*** Create interface with extends custom interface.
        * [ ***REMOVED*** Create interface with extends custom interface with namespace
    * [ ***REMOVED*** **[5.2***REMOVED***** src-repository [Module PbrSrcRepository***REMOVED***
        * [X***REMOVED*** Implements
            * [X***REMOVED*** Create Repository Implements Interface
            * [X***REMOVED*** Create Repository with custom namespace Implements Interface            
    
    * [ ***REMOVED*** **[5.3***REMOVED***** src-service                  
    * [ ***REMOVED*** src-form
    * [ ***REMOVED*** src-filter
    * [ ***REMOVED*** src-viewhelper
    * [ ***REMOVED*** src-controllerplugin
* [ ***REMOVED*** **[6***REMOVED*****. src-mvc
* [ ***REMOVED*** **[7***REMOVED*****. app

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



ControllerTests 


ModuleTests
DatabaseTests
ProjectTests 

DiagnosticTests


