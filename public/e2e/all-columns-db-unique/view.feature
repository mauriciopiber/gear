# language: pt

@my-module @all-columns-db-unique @all-columns-db-unique-view

Funcionalidade: Visualizar um All Columns Db Unique cadastrado.

  Como Administrador, quero visualizar os dados de um All Columns Db Unique cadastrado.

    @layout
    Cenário: Acesso a página de Visualizar All Columns Db Unique.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Unique - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      Quando eu clico no botão Visualizar no ítem ID "30"
      Então eu vejo o título "Visualizar All Columns Db Unique - Admin PiberNetwork"
      E eu vejo o título central "Visualizar All Columns Db Unique - 30"
      E eu vejo o breadscrumb "My Module / All Columns Db Unique / Visualizar"
      E eu vejo o atributo "Varchar Upload Image Unique" com a imagem "/upload/all-columns-db-unique-varcharUploadImageUnique/pre30varcharUploadImageUnique.gif"
      E eu vejo o atributo "Varchar Url Unique" com o valor "varchar.url.unique30.com.br"
      E eu vejo o atributo "Varchar Varchar Unique" com o valor "30Varchar Varchar Unique"
      E eu vejo o atributo "Varchar Telephone Unique" com o valor "(51) 9999-9930"
      E eu vejo o atributo "Varchar Email Unique" com o valor "varchar.email.unique30@gmail.com"
      E eu vejo o atributo "Date Date Unique" com o valor "2007-06-30"
      E eu vejo o atributo "Date Date Pt Br Unique" com o valor "30/06/2007"
      E eu vejo o atributo "Datetime Datetime Unique" com o valor "2007-06-30 06:00:30"
      E eu vejo o atributo "Datetime Datetime Pt Br Unique" com o valor "30/06/2007 06:00:30"
      E eu vejo o atributo "Time Time Unique" com o valor "06:00:30"
      E eu vejo o atributo "Decimal Decimal Unique" com o valor "30.30"
      E eu vejo o atributo "Decimal Money Pt Br Unique" com o valor "R$ 30,30"
      E eu vejo o atributo "Int Int Unique" com o valor "30"
      E eu vejo o atributo "Int Checkbox Unique" com o valor "Não"
      E eu vejo o atributo "Int Foreign Key Unique" com o valor "30Dep Name"
      E eu vejo o atributo "Boolean Int Unique" com o valor "Não"
      E eu vejo o atributo "Boolean Checkbox Unique" com o valor "Não"
      E eu vejo o atributo "Text Text Unique" com o valor "30Text Text Unique"
      E eu vejo o atributo "Text Html Unique" com o valor "30Text Html Unique"
      E eu vejo o botão de Voltar
      E eu vejo o botão de Novo
      E eu vejo o botão de Editar
      E eu vejo o botão de Excluir
