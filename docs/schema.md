## Json Schema 

Estrutura Completa

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


## App

| Parametro | Descrição |
|:--|:--|
| Name | Nome que será utilizado tanto no nome do App quanto nas views. |
| Type | Tipo, pode ser Controller ou Service. |
| Dependency | Lista de outros Apps que serão injetados neste App na criação. |
| Db | Informa uma tabela para usar como skin para simular o create db. |
| Namespace | Localização do App dentro do sistema de arquivos. |


## Src

| Parametro | Descrição |
|:--|:--|
| Name | Nome que será utilizando para a classe e o servicemanager. |
| Type | Tipo de SRC que será criado. |
| Dependency | Cria as dependências de outros SRCs com Trait. |
| Db | Informa uma tabela pra usar como skin e simular o create db. |
| Namespace | Localização do SRC dentro do namespace PSR-0 |
| Extends | Nome namespace de um src pai para o src |
| Abstract | Informa se o SRC deve ser criado com skin de classe abstrata |
| Service | Escolhe se será criado por invokable ou factories, define a estrutura da classe |
| Template | Escolhe um template default para o arquivo, no caso de Factory |
