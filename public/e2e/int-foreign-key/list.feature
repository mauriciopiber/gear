# language: pt

@my-module @int-foreign-key @int-foreign-key-list

Funcionalidade: Listar Int Foreign Key cadastrados.

  Como Administrador, quero listar os Int Foreign Key cadastrados.

  Cenário: Acesso a página de listar Int Foreign Key.
    Dado que eu estou logado na página principal
    Quando eu clico no menu "My Module - Int Foreign Key - Listar"
    Então eu vejo o título "Listar Int Foreign Key - Admin PiberNetwork"
    E eu vejo o título central "Int Foreign Key"
    E eu vejo o breadscrumb "My Module / Int Foreign Key / Listar"
    E eu vejo "10" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 10 de 30" na paginação
    E eu vejo o campo "Int Foreign Key" com o valor "30" na linha "1"
    E eu vejo o campo "Dep Name" com o valor "30Dep Name" na linha "1"
    E eu vejo o botão de Criar
    E eu vejo o botão de Exibir Filtro

  @pagination
  Cenário: Paginar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - Int Foreign Key - Listar"
    E eu vejo o ítem ID "30" na linha "1"
    E eu vejo o ítem ID "21" na linha "10"
    Quando eu clico na paginação "2"
    Então eu vejo o ítem ID "20" na linha "1"
    E eu vejo o ítem ID "11" na linha "10"

  @filter
  Cenário: Filtrar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - Int Foreign Key - Listar"
    E eu vejo "10" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 10 de 30" na paginação
    Quando eu clico em Exibir Filtro
    E eu digito "20Dep Name" no filtro "Palavra Chave"
    Então eu vejo "1" ítens cadastrados
    E eu vejo que está "Mostrando 1 - 1 de 1" na paginação

  @order
  Cenário: Ordenar os resultados da listagem
    Dado que eu estou logado na página principal
    E eu clico no menu "My Module - Int Foreign Key - Listar"
    E eu vejo o ítem ID "30" na linha "1"
    Quando eu clico em ordem na coluna "Int Foreign Key"
    Então eu vejo o ítem ID "1" na linha "1"
