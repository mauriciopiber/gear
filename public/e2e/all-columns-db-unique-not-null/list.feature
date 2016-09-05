# language: pt

@my-module @all-columns-db-unique-not-null @all-columns-db-unique-not-null-list

Funcionalidade: Listar All Columns Db Unique Not Null cadastrados.

  Como Administrador, quero listar os All Columns Db Unique Not Null cadastrados.

  Cenário: Acesso a página de listar All Columns Db Unique Not Null.
    Dado que eu estou logado na página principal
    Quando eu clico no menu "My Module - All Columns Db Unique Not Null - Listar"
    Então eu vejo o título "Listar All Columns Db Unique Not Null - Admin PiberNetwork"
    E eu vejo o título central "All Columns Db Unique Not Null"
    E eu vejo o breadscrumb "My Module / All Columns Db Unique Not Null / Listar"
    E eu vejo "10" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 10 de 30" na paginação
    E eu vejo o campo "All Columns Db Unique Not Null" com o valor "30" na linha "1"
    E eu vejo o campo "Varchar Url Unique Not Null" com o valor "varchar.url.unique.not.null30.com.br" na linha "1"
    E eu vejo o campo "Varchar Varchar Unique Not Null" com o valor "30Varchar Varchar Unique Not Null" na linha "1"
    E eu vejo o campo "Varchar Telephone Unique Not Null" com o valor "(51) 9999-9930" na linha "1"
    E eu vejo o campo "Varchar Email Unique Not Null" com o valor "varchar.email.unique.not.null30@gmail.com" na linha "1"
    E eu vejo o campo "Date Date Unique Not Null" com o valor "2007-06-30" na linha "1"
    E eu vejo o campo "Date Date Pt Br Unique Not Null" com o valor "30/06/2007" na linha "1"
    E eu vejo o campo "Datetime Datetime Unique Not Null" com o valor "2007-06-30 06:00:30" na linha "1"
    E eu vejo o campo "Datetime Datetime Pt Br Unique Not Null" com o valor "30/06/2007 06:00:30" na linha "1"
    E eu vejo o campo "Time Time Unique Not Null" com o valor "06:00:30" na linha "1"
    E eu vejo o campo "Decimal Decimal Unique Not Null" com o valor "30.30" na linha "1"
    E eu vejo o campo "Decimal Money Pt Br Unique Not Null" com o valor "R$ 30,30" na linha "1"
    E eu vejo o campo "Int Int Unique Not Null" com o valor "30" na linha "1"
    E eu vejo o campo "Int Foreign Key Unique Not Null" com o valor "30Dep Name" na linha "1"
    E eu vejo o campo "Boolean Int Unique Not Null" com o valor "Não" na linha "1"
    E eu vejo o campo "Boolean Checkbox Unique Not Null" com o valor "Não" na linha "1"
    E eu vejo o botão de Criar
    E eu vejo o botão de Exibir Filtro

  @pagination
  Cenário: Paginar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - All Columns Db Unique Not Null - Listar"
    E eu vejo o ítem ID "30" na linha "1"
    E eu vejo o ítem ID "21" na linha "10"
    Quando eu clico na paginação "2"
    Então eu vejo o ítem ID "20" na linha "1"
    E eu vejo o ítem ID "11" na linha "10"

  @filter
  Cenário: Filtrar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - All Columns Db Unique Not Null - Listar"
    E eu vejo "10" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 10 de 30" na paginação
    Quando eu clico em Exibir Filtro
    E eu digito "20Varchar Varchar Unique Not Null" no filtro "Palavra Chave"
    Então eu vejo "1" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 1 de 1" na paginação

  @order
  Cenário: Ordenar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - All Columns Db Unique Not Null - Listar"
    E eu vejo o ítem ID "30" na linha "1"
    Quando eu clico em ordem na coluna "All Columns Db Unique Not Null"
    Então eu vejo o ítem ID "1" na linha "1"
