# language: pt

@my-module @all-columns-db-not-null @all-columns-db-not-null-edit @edit

Funcionalidade: Editar All Columns Db Not Null existente.

  Como Administrador, quero editar um All Columns Db Not Null já existente.

    @layout
    Cenário: Editar All Columns Db Not Null com sucesso.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Not Null - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      E eu vejo o título "Editar All Columns Db Not Null - Admin PiberNetwork"
      E eu vejo o título central "Editar All Columns Db Not Null - 30"
      E eu vejo o breadscrumb "My Module / All Columns Db Not Null / Editar"
      E eu vejo o botão de Salvar
      E eu vejo o botão de Voltar
      E eu vejo o botão de Visualizar
      E eu vejo o botão de Criar

    @tearDown @all-columns-db-not-null-fixture @logValidation
    Cenário: Editar All Columns Db Not Null com sucesso.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Not Null - Listar"
      E eu vejo o ítem ID "75" na linha "1"
      E eu clico no botão Editar no ítem ID "75"
      E eu vejo o valor "" no campo "Varchar Password Verify Not Null"
      E eu vejo o valor "" no campo "Varchar Password Verify Not Null Verify"
      E eu vejo a imagem "/upload/all-columns-db-not-null-varcharUploadImageNotNull/pre75varcharUploadImageNotNull.gif" no campo "Varchar Upload Image Not Null"
      E eu vejo o valor "varchar.url.not.null75.com.br" no campo "Varchar Url Not Null"
      E eu vejo o valor "75Varchar Varchar Not Null" no campo "Varchar Varchar Not Null"
      E eu vejo o valor "(51) 9999-9975" no campo "Varchar Telephone Not Null"
      E eu vejo o valor "varchar.email.not.null75@gmail.com" no campo "Varchar Email Not Null"
      E eu vejo o valor "2006-03-15" no campo "Date Date Not Null"
      E eu vejo o valor "15/03/2006" no campo "Date Date Pt Br Not Null"
      E eu vejo o valor "2006-03-15 03:00:15" no campo "Datetime Datetime Not Null"
      E eu vejo o valor "15/03/2006 03:00:15" no campo "Datetime Datetime Pt Br Not Null"
      E eu vejo o valor "03:00:15" no campo "Time Time Not Null"
      E eu vejo o valor "75.75" no campo "Decimal Decimal Not Null"
      E eu vejo o valor "R$ 75,75" no campo "Decimal Money Pt Br Not Null"
      E eu vejo o valor "75" no campo "Int Int Not Null"
      E eu vejo marcada a caixa de escolha "Int Checkbox Not Null"
      E eu vejo escolhido "15Dep Name" na caixa para selecionar "Int Foreign Key Not Null"
      E eu vejo marcada a caixa de escolha "Boolean Int Not Null"
      E eu vejo marcada a caixa de escolha "Boolean Checkbox Not Null"
      E eu vejo texto "75Text Text Not Null" no campo "Text Text Not Null"
      E eu vejo texto "75Text Html Not Null" no campo html "Text Html Not Null"
      Quando eu entro com o valor "55VarcharPasswordVer" no campo "Varchar Password Verify Not Null"
      E eu entro com o valor "55VarcharPasswordVer" no campo "Varchar Password Verify Not Null Verify"
      E eu entro com uma imagem no campo "Varchar Upload Image Not Null"
      E eu entro com o valor "varchar.url.not.null55.com.br" no campo "Varchar Url Not Null"
      E eu entro com o valor "55Varchar Varchar Not Null" no campo "Varchar Varchar Not Null"
      E eu entro com o valor "(51) 9999-9955" no campo "Varchar Telephone Not Null"
      E eu entro com o valor "varchar.email.not.null55@gmail.com" no campo "Varchar Email Not Null"
      E eu entro com o valor "2009-07-25" no campo "Date Date Not Null"
      E eu entro com o valor "25/07/2009" no campo "Date Date Pt Br Not Null"
      E eu entro com o valor "2009-07-25 07:00:55" no campo "Datetime Datetime Not Null"
      E eu entro com o valor "25/07/2009 07:00:55" no campo "Datetime Datetime Pt Br Not Null"
      E eu entro com o valor "07:00:55" no campo "Time Time Not Null"
      E eu entro com o valor "55.55" no campo "Decimal Decimal Not Null"
      E eu entro com o valor "R$ 55,55" no campo "Decimal Money Pt Br Not Null"
      E eu entro com o valor "55" no campo "Int Int Not Null"
      E eu marco a caixa de escolha "Int Checkbox Not Null"
      E eu escolho o valor "25Dep Name" na caixa para selecionar "Int Foreign Key Not Null"
      E eu marco a caixa de escolha "Boolean Int Not Null"
      E eu marco a caixa de escolha "Boolean Checkbox Not Null"
      E eu entro com o texto "55Text Text Not Null" no campo "Text Text Not Null"
      E eu entro com o texto "55Text Html Not Null" no campo html "Text Html Not Null"
      E eu clico no botão Salvar
      Então eu vejo a mensagem que foi "Sucesso! Os dados foram salvos corretamente."
      E eu vejo o valor "" no campo "Varchar Password Verify Not Null"
      E eu vejo o valor "" no campo "Varchar Password Verify Not Null Verify"
      E eu vejo a imagem "/upload/all-columns-db-not-null-varcharUploadImageNotNull/prefake-image.png" no campo "Varchar Upload Image Not Null"
      E eu vejo o valor "varchar.url.not.null55.com.br" no campo "Varchar Url Not Null"
      E eu vejo o valor "55Varchar Varchar Not Null" no campo "Varchar Varchar Not Null"
      E eu vejo o valor "(51) 9999-9955" no campo "Varchar Telephone Not Null"
      E eu vejo o valor "varchar.email.not.null55@gmail.com" no campo "Varchar Email Not Null"
      E eu vejo o valor "2009-07-25" no campo "Date Date Not Null"
      E eu vejo o valor "25/07/2009" no campo "Date Date Pt Br Not Null"
      E eu vejo o valor "2009-07-25 07:00:55" no campo "Datetime Datetime Not Null"
      E eu vejo o valor "25/07/2009 07:00:55" no campo "Datetime Datetime Pt Br Not Null"
      E eu vejo o valor "07:00:55" no campo "Time Time Not Null"
      E eu vejo o valor "55.55" no campo "Decimal Decimal Not Null"
      E eu vejo o valor "R$ 55,55" no campo "Decimal Money Pt Br Not Null"
      E eu vejo o valor "55" no campo "Int Int Not Null"
      E eu vejo marcada a caixa de escolha "Int Checkbox Not Null"
      E eu vejo escolhido "25Dep Name" na caixa para selecionar "Int Foreign Key Not Null"
      E eu vejo marcada a caixa de escolha "Boolean Int Not Null"
      E eu vejo marcada a caixa de escolha "Boolean Checkbox Not Null"
      E eu vejo texto "55Text Text Not Null" no campo "Text Text Not Null"
      E eu vejo texto "55Text Html Not Null" no campo html "Text Html Not Null"

    @form-validate-null
    Cenário: Edito All Columns Db Not Null com os campos em branco
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Not Null - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      Quando eu limpo os campos
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Varchar Url Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Varchar Varchar Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Varchar Telephone Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Varchar Email Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Date Date Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Date Date Pt Br Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Datetime Datetime Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Datetime Datetime Pt Br Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Time Time Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Decimal Decimal Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Int Int Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Int Foreign Key Not Null"

    @form-validate-invalid
    Cenário: Edito All Columns Db Not Null com formatos inválidos
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Not Null - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      E eu entro com o valor "ABCDEF" no campo "Varchar Url Not Null"
      E eu entro com o valor "ABCDEF" no campo "Varchar Telephone Not Null"
      E eu entro com o valor "ABCDEF" no campo "Varchar Email Not Null"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Url Not Null"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Telephone Not Null"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Email Not Null"

    @form-validate-max
    Cenário: Edito All Columns Db Not Null com valores com numero de caracteres acima do permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Not Null - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      E eu entro com o valor "abcdefghijklmnopqrstu" no campo "Varchar Password Verify Not Null"
      E eu entro com o valor "abcdefghijklmnopqrstu" no campo "Varchar Password Verify Not Null Verify"
      E eu entro com o valor "abcdefghijklmnopqrstujxywzabcdefghijklmnopqrst" no campo "Varchar Varchar Not Null"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 20 caracteres" no campo "Varchar Password Verify Not Null"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 20 caracteres" no campo "Varchar Password Verify Not Null Verify"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 45 caracteres" no campo "Varchar Varchar Not Null"

    @form-validate-min
    Cenário: Edito All Columns Db Not Null com valores com numero de caracteres menor que o permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Not Null - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      E eu entro com o valor "ab" no campo "Varchar Password Verify Not Null"
      E eu entro com o valor "ab" no campo "Varchar Password Verify Not Null Verify"
      E eu entro com o valor "ab" no campo "Varchar Varchar Not Null"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 6 caracteres" no campo "Varchar Password Verify Not Null"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 6 caracteres" no campo "Varchar Password Verify Not Null Verify"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 3 caracteres" no campo "Varchar Varchar Not Null"
