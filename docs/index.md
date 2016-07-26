# Pibernetwork Gear

## Tabela de conteúdos

  1. [Module***REMOVED***(/module)
  1. [Project***REMOVED***(/project)
  1. [Cache***REMOVED***(/cache)
  1. [Database***REMOVED***(/database)
  1. [Constructor***REMOVED***(/constructor)

## O que é o Gear?

Gear Reune todas tarefas relacionadas a criação de módulos e projetos.

O Gear é um criador de módulos, que teve que assumir outras responsábilidades, mas todas focadas na produção em tempo recorde de módulos zf3, entregue em projetos.

Gerador de sistemas.

Automatizador de processos.

O processo básico do Gear é criar um sistema e colocar direto em produção, com todo processo realizado e testado por integração contínua.


Para isso, é necessário gerar o sistema e automatizar os processos.

## Estrutura própria.

Para realizar os trabalhos, foi criado um sistema próprio de administração de ferramentas, tecnologias e código necessário.


**Mvc** é o termo utilizado para descrever um arquivo gerado utilizando PHP, composto por classes, interfaces, traits.

No momento, o **Mvc** utiliza padrão Domain Drive Design, utilizando a prática de testes unitários para confirmar que está funcionando e já pode ser incrementada.

**Db** no contexto Gear, é o termo utilizado para gerar todos Mvcs necessários para Acessar o Crud no administrador.

**Column** é o termo utilizado para descrever as características que cada coluna do banco de dados deve ter na aplicação. 

**User Type** é o termo utilizado para descrever as permissões básicas do usuário.

**Table** é o termo utilizado para descrever as características de uma determinada tabela deve implicar no sistema.

Utilizando essa lógica, temos:

constructor -> mvc[1-N***REMOVED*** <-> column  
               mvc[1-N***REMOVED*** <-> table
               mvc[1-1***REMOVED*** <-> user-type
               mvc[1-N***REMOVED*** -> render();
               
               
a estrutura de arquivos e templates deve obedecer a ordem:

module/mvc/[controller/src-type/app-type***REMOVED***/
               

## Objetivos


1. Documentar todos comandos.
2. Explicar a construção de cada componente, de todos comandos.


## Milestone 

v1.0.0 - 25/05/2016