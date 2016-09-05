# language: pt

@my-module @all-columns-db-not-null @all-columns-db-not-null-view

Funcionalidade: Visualizar um All Columns Db Not Null cadastrado.

  Como Administrador, quero visualizar os dados de um All Columns Db Not Null cadastrado.

    @layout
    Cenário: Acesso a página de Visualizar All Columns Db Not Null.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Not Null - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      Quando eu clico no botão Visualizar no ítem ID "30"
      Então eu vejo o título "Visualizar All Columns Db Not Null - Admin PiberNetwork"
      E eu vejo o título central "Visualizar All Columns Db Not Null - 30"
      E eu vejo o breadscrumb "My Module / All Columns Db Not Null / Visualizar"
      E eu vejo o atributo "Varchar Upload Image Not Null" com a imagem "/upload/all-columns-db-not-null-varcharUploadImageNotNull/pre30varcharUploadImageNotNull.gif"
      E eu vejo o atributo "Varchar Url Not Null" com o valor "varchar.url.not.null30.com.br"
      E eu vejo o atributo "Varchar Varchar Not Null" com o valor "30Varchar Varchar Not Null"
      E eu vejo o atributo "Varchar Telephone Not Null" com o valor "(51) 9999-9930"
      E eu vejo o atributo "Varchar Email Not Null" com o valor "varchar.email.not.null30@gmail.com"
      E eu vejo o atributo "Date Date Not Null" com o valor "2007-06-30"
      E eu vejo o atributo "Date Date Pt Br Not Null" com o valor "30/06/2007"
      E eu vejo o atributo "Datetime Datetime Not Null" com o valor "2007-06-30 06:00:30"
      E eu vejo o atributo "Datetime Datetime Pt Br Not Null" com o valor "30/06/2007 06:00:30"
      E eu vejo o atributo "Time Time Not Null" com o valor "06:00:30"
      E eu vejo o atributo "Decimal Decimal Not Null" com o valor "30.30"
      E eu vejo o atributo "Decimal Money Pt Br Not Null" com o valor "R$ 30,30"
      E eu vejo o atributo "Int Int Not Null" com o valor "30"
      E eu vejo o atributo "Int Checkbox Not Null" com o valor "Não"
      E eu vejo o atributo "Int Foreign Key Not Null" com o valor "30Dep Name"
      E eu vejo o atributo "Boolean Int Not Null" com o valor "Não"
      E eu vejo o atributo "Boolean Checkbox Not Null" com o valor "Não"
      E eu vejo o atributo "Text Text Not Null" com o valor "30Text Text Not Null"
      E eu vejo o atributo "Text Html Not Null" com o valor "30Text Html Not Null"
      E eu vejo o botão de Voltar
      E eu vejo o botão de Novo
      E eu vejo o botão de Editar
      E eu vejo o botão de Excluir
