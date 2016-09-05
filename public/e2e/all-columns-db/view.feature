# language: pt

@my-module @all-columns-db @all-columns-db-view

Funcionalidade: Visualizar um All Columns Db cadastrado.

  Como Administrador, quero visualizar os dados de um All Columns Db cadastrado.

    @layout-now1 @link
    Cenário: Acesso a página de Visualizar All Columns Db.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      Quando eu clico no botão Visualizar no ítem ID "30"
      Então eu vejo o título "Visualizar All Columns Db - Admin PiberNetwork"
      E eu vejo o título central "Visualizar All Columns Db - 30"
      E eu vejo o breadscrumb "My Module / All Columns Db / Visualizar"
      E eu vejo o atributo "Varchar Upload Image" com a imagem "/upload/all-columns-db-varcharUploadImage/pre30varcharUploadImage.gif"
      E eu vejo o atributo "Varchar Url" com o valor "varchar.url30.com.br"
      E eu vejo o atributo "Varchar Varchar" com o valor "30Varchar Varchar"
      E eu vejo o atributo "Varchar Telephone" com o valor "(51) 9999-9930"
      E eu vejo o atributo "Varchar Email" com o valor "varchar.email30@gmail.com"
      E eu vejo o atributo "Date Date" com o valor "2007-06-30"
      E eu vejo o atributo "Date Date Pt Br" com o valor "30/06/2007"
      E eu vejo o atributo "Datetime Datetime" com o valor "2007-06-30 06:00:30"
      E eu vejo o atributo "Datetime Datetime Pt Br" com o valor "30/06/2007 06:00:30"
      E eu vejo o atributo "Time Time" com o valor "06:00:30"
      E eu vejo o atributo "Decimal Decimal" com o valor "30.30"
      E eu vejo o atributo "Decimal Money Pt Br" com o valor "R$ 30,30"
      E eu vejo o atributo "Int Int" com o valor "30"
      E eu vejo o atributo "Int Checkbox" com o valor "Não"
      E eu vejo o atributo "Int Foreign Key" com o valor "30Dep Name"
      E eu vejo o atributo "Boolean Int" com o valor "Não"
      E eu vejo o atributo "Boolean Checkbox" com o valor "Não"
      E eu vejo o atributo "Text Text" com o valor "30Text Text"
      E eu vejo o atributo "Text Html" com o valor "30Text Html"
      E eu vejo o botão de Voltar
      E eu vejo o botão de Novo
      E eu vejo o botão de Editar
      E eu vejo o botão de Excluir
