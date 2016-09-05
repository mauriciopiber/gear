# language: pt

@my-module @all-columns-db @all-columns-db-list @now1

Funcionalidade: Listar All Columns Db cadastrados.

  Como Administrador, quero listar os All Columns Db cadastrados.

  @layout-now @now2
  Cenário: Acesso a página de listar All Columns Db.
    Dado que eu estou logado na página principal
    Quando eu clico no menu "My Module - All Columns Db - Listar"
    Então eu vejo o título "Listar All Columns Db - Admin PiberNetwork"
    E eu vejo o título central "All Columns Db"
    E eu vejo o breadscrumb "My Module / All Columns Db / Listar"
    E eu vejo "10" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 10 de 30" na paginação
    E eu vejo o campo "All Columns Db" com o valor "30" na linha "1"
    E eu vejo o campo "Varchar Url" com o valor "varchar.url30.com.br" na linha "1"
    E eu vejo o campo "Varchar Varchar" com o valor "30Varchar Varchar" na linha "1"
    E eu vejo o campo "Varchar Telephone" com o valor "(51) 9999-9930" na linha "1"
    E eu vejo o campo "Varchar Email" com o valor "varchar.email30@gmail.com" na linha "1"
    E eu vejo o campo "Date Date" com o valor "2007-06-30" na linha "1"
    E eu vejo o campo "Date Date Pt Br" com o valor "30/06/2007" na linha "1"
    E eu vejo o campo "Datetime Datetime" com o valor "2007-06-30 06:00:30" na linha "1"
    E eu vejo o campo "Datetime Datetime Pt Br" com o valor "30/06/2007 06:00:30" na linha "1"
    E eu vejo o campo "Time Time" com o valor "06:00:30" na linha "1"
    E eu vejo o campo "Decimal Decimal" com o valor "30.30" na linha "1"
    E eu vejo o campo "Decimal Money Pt Br" com o valor "R$ 30,30" na linha "1"
    E eu vejo o campo "Int Int" com o valor "30" na linha "1"
    E eu vejo o campo "Int Foreign Key" com o valor "30Dep Name" na linha "1"
    E eu vejo o campo "Boolean Int" com o valor "Não" na linha "1"
    E eu vejo o campo "Boolean Checkbox" com o valor "Não" na linha "1"
    E eu vejo o botão de Criar
    E eu vejo o botão de Exibir Filtro

  @pagination @now5
  Cenário: Paginar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - All Columns Db - Listar"
    E eu vejo o ítem ID "30" na linha "1"
    E eu vejo o ítem ID "21" na linha "10"
    Quando eu clico na paginação "2"
    Então eu vejo o ítem ID "20" na linha "1"
    E eu vejo o ítem ID "11" na linha "10"

  @filter @now11
  Cenário: Filtrar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - All Columns Db - Listar"
    E eu vejo "10" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 10 de 30" na paginação
    Quando eu clico em Exibir Filtro
    E eu digito "20Varchar Varchar" no filtro "Palavra Chave"
    Então eu vejo "1" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 1 de 1" na paginação

  @order @notnow1
  Cenário: Ordenar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - All Columns Db - Listar"
    E eu vejo o ítem ID "30" na linha "1"
    Quando eu clico em ordem na coluna "All Columns Db"
    Então eu vejo o ítem ID "1" na linha "1"
