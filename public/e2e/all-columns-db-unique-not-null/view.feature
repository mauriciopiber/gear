# language: pt

@my-module @all-columns-db-unique-not-null @all-columns-db-unique-not-null-view

Funcionalidade: Visualizar um All Columns Db Unique Not Null cadastrado.

  Como Administrador, quero visualizar os dados de um All Columns Db Unique Not Null cadastrado.

    @layout
    Cenário: Acesso a página de Visualizar All Columns Db Unique Not Null.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Unique Not Null - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      Quando eu clico no botão Visualizar no ítem ID "30"
      Então eu vejo o título "Visualizar All Columns Db Unique Not Null - Admin PiberNetwork"
      E eu vejo o título central "Visualizar All Columns Db Unique Not Null - 30"
      E eu vejo o breadscrumb "My Module / All Columns Db Unique Not Null / Visualizar"
      E eu vejo o atributo "Varchar Upload Image Unique Not Null" com a imagem "/upload/all-columns-db-unique-not-null-varcharUploadImageUniqueNotNull/pre30varcharUploadImageUniqueNotNull.gif"
      E eu vejo o atributo "Varchar Url Unique Not Null" com o valor "varchar.url.unique.not.null30.com.br"
      E eu vejo o atributo "Varchar Varchar Unique Not Null" com o valor "30Varchar Varchar Unique Not Null"
      E eu vejo o atributo "Varchar Telephone Unique Not Null" com o valor "(51) 9999-9930"
      E eu vejo o atributo "Varchar Email Unique Not Null" com o valor "varchar.email.unique.not.null30@gmail.com"
      E eu vejo o atributo "Date Date Unique Not Null" com o valor "2007-06-30"
      E eu vejo o atributo "Date Date Pt Br Unique Not Null" com o valor "30/06/2007"
      E eu vejo o atributo "Datetime Datetime Unique Not Null" com o valor "2007-06-30 06:00:30"
      E eu vejo o atributo "Datetime Datetime Pt Br Unique Not Null" com o valor "30/06/2007 06:00:30"
      E eu vejo o atributo "Time Time Unique Not Null" com o valor "06:00:30"
      E eu vejo o atributo "Decimal Decimal Unique Not Null" com o valor "30.30"
      E eu vejo o atributo "Decimal Money Pt Br Unique Not Null" com o valor "R$ 30,30"
      E eu vejo o atributo "Int Int Unique Not Null" com o valor "30"
      E eu vejo o atributo "Int Checkbox Unique Not Null" com o valor "Não"
      E eu vejo o atributo "Int Foreign Key Unique Not Null" com o valor "30Dep Name"
      E eu vejo o atributo "Boolean Int Unique Not Null" com o valor "Não"
      E eu vejo o atributo "Boolean Checkbox Unique Not Null" com o valor "Não"
      E eu vejo o atributo "Text Text Unique Not Null" com o valor "30Text Text Unique Not Null"
      E eu vejo o atributo "Text Html Unique Not Null" com o valor "30Text Html Unique Not Null"
      E eu vejo o botão de Voltar
      E eu vejo o botão de Novo
      E eu vejo o botão de Editar
      E eu vejo o botão de Excluir
