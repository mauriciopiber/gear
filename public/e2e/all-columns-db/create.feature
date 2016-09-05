# language: pt

@my-module @all-columns-db @all-columns-db-create @create @foi
Funcionalidade: Cadastrar novo All Columns Db.

  Como Administrador, quero cadastrar um novo All Columns Db.

    @layout @layout-now
    Cenário: Acesso a página de Criar All Columns Db pelo menu principal
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - All Columns Db - Criar"
      Então eu vejo o título "Criar All Columns Db - Admin PiberNetwork"
      E eu vejo o título central "Criar All Columns Db"
      E eu vejo o breadscrumb "My Module / All Columns Db / Criar"
      E eu vejo o botão de Salvar
      E eu vejo o botão de Voltar

    @tearDown @logValidation @form-success @layout-now3
    Cenário: Acesso a página de Criar All Columns Db.
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - All Columns Db - Criar"
      E eu entro com o valor "55VarcharPasswordVer" no campo "Varchar Password Verify"
      E eu entro com o valor "55VarcharPasswordVer" no campo "Varchar Password Verify Verify"
      E eu entro com uma imagem no campo "Varchar Upload Image"
      E eu entro com o valor "varchar.url55.com.br" no campo "Varchar Url"
      E eu entro com o valor "55Varchar Varchar" no campo "Varchar Varchar"
      E eu entro com o valor "(51) 9999-9955" no campo "Varchar Telephone"
      E eu entro com o valor "varchar.email55@gmail.com" no campo "Varchar Email"
      E eu entro com o valor "2009-07-25" no campo "Date Date"
      E eu entro com o valor "25/07/2009" no campo "Date Date Pt Br"
      E eu entro com o valor "2009-07-25 07:00:55" no campo "Datetime Datetime"
      E eu entro com o valor "25/07/2009 07:00:55" no campo "Datetime Datetime Pt Br"
      E eu entro com o valor "07:00:55" no campo "Time Time"
      E eu entro com o valor "55.55" no campo "Decimal Decimal"
      E eu entro com o valor "R$ 55,55" no campo "Decimal Money Pt Br"
      E eu entro com o valor "55" no campo "Int Int"
      E eu marco a caixa de escolha "Int Checkbox"
      E eu escolho o valor "25Dep Name" na caixa para selecionar "Int Foreign Key"
      E eu marco a caixa de escolha "Boolean Int"
      E eu marco a caixa de escolha "Boolean Checkbox"
      E eu entro com o texto "55Text Text" no campo "Text Text"
      E eu entro com o texto "55Text Html" no campo html "Text Html"
      E eu clico no botão Salvar
      Então eu vejo a mensagem que foi "Sucesso! Os dados foram salvos corretamente."
      E eu vejo o valor "" no campo "Varchar Password Verify"
      E eu vejo o valor "" no campo "Varchar Password Verify Verify"
      E eu vejo a imagem "/upload/all-columns-db-varcharUploadImage/prefake-image.png" no campo "Varchar Upload Image"
      E eu vejo o valor "varchar.url55.com.br" no campo "Varchar Url"
      E eu vejo o valor "55Varchar Varchar" no campo "Varchar Varchar"
      E eu vejo o valor "(51) 9999-9955" no campo "Varchar Telephone"
      E eu vejo o valor "varchar.email55@gmail.com" no campo "Varchar Email"
      E eu vejo o valor "2009-07-25" no campo "Date Date"
      E eu vejo o valor "25/07/2009" no campo "Date Date Pt Br"
      E eu vejo o valor "2009-07-25 07:00:55" no campo "Datetime Datetime"
      E eu vejo o valor "25/07/2009 07:00:55" no campo "Datetime Datetime Pt Br"
      E eu vejo o valor "07:00:55" no campo "Time Time"
      E eu vejo o valor "55.55" no campo "Decimal Decimal"
      E eu vejo o valor "R$ 55,55" no campo "Decimal Money Pt Br"
      E eu vejo o valor "55" no campo "Int Int"
      E eu vejo marcada a caixa de escolha "Int Checkbox"
      E eu vejo escolhido "25Dep Name" na caixa para selecionar "Int Foreign Key"
      E eu vejo marcada a caixa de escolha "Boolean Int"
      E eu vejo marcada a caixa de escolha "Boolean Checkbox"
      E eu vejo texto "55Text Text" no campo "Text Text"
      E eu vejo texto "55Text Html" no campo html "Text Html"

    @tearDown @form-validate-null @tt1
    Cenário: Crio All Columns Db com os campos em banco
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - All Columns Db - Criar"
      E eu clico no botão Salvar
      Então eu vejo a mensagem que foi "Sucesso! Os dados foram salvos corretamente."
      E eu vejo o valor "" no campo "Varchar Password Verify"
      E eu vejo o valor "" no campo "Varchar Password Verify Verify"
      E eu vejo a imagem vazia no campo "Varchar Upload Image"
      E eu vejo o valor "" no campo "Varchar Url"
      E eu vejo o valor "" no campo "Varchar Varchar"
      E eu vejo o valor "" no campo "Varchar Telephone"
      E eu vejo o valor "" no campo "Varchar Email"
      E eu vejo o valor "" no campo "Date Date"
      E eu vejo o valor "" no campo "Date Date Pt Br"
      E eu vejo o valor "" no campo "Datetime Datetime"
      E eu vejo o valor "" no campo "Datetime Datetime Pt Br"
      E eu vejo o valor "" no campo "Time Time"
      E eu vejo o valor "" no campo "Decimal Decimal"
      E eu vejo o valor "" no campo "Decimal Money Pt Br"
      E eu vejo o valor "" no campo "Int Int"
      E eu vejo desmarcada a caixa de escolha "Int Checkbox"
      E eu vejo escolhido "Escolher:" na caixa para selecionar "Int Foreign Key"
      E eu vejo desmarcada a caixa de escolha "Boolean Int"
      E eu vejo desmarcada a caixa de escolha "Boolean Checkbox"
      E eu vejo texto "" no campo "Text Text"
      E eu vejo texto "" no campo html "Text Html"

    @form-validate-invalid @f1
    Cenário: Crio All Columns Db com formatos inválidos
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db - Criar"
      E eu entro com o valor "ABCDEF" no campo "Varchar Url"
      E eu entro com o valor "ABCDEF" no campo "Varchar Telephone"
      E eu entro com o valor "ABCDEF" no campo "Varchar Email"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Url"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Telephone"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Email"

    @form-validate-max
    Cenário: Crio All Columns Db com valores com numero de caracteres acima do permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db - Criar"
      E eu entro com o valor "abcdefghijklmnopqrstu" no campo "Varchar Password Verify"
      E eu entro com o valor "abcdefghijklmnopqrstu" no campo "Varchar Password Verify Verify"
      E eu entro com o valor "abcdefghijklmnopqrstujxywzabcdefghijklmnopqrst" no campo "Varchar Varchar"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 20 caracteres" no campo "Varchar Password Verify"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 20 caracteres" no campo "Varchar Password Verify Verify"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 45 caracteres" no campo "Varchar Varchar"

    @form-validate-min
    Cenário: Crio All Columns Db com valores com numero de caracteres menor que o permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db - Criar"
      E eu entro com o valor "ab" no campo "Varchar Password Verify"
      E eu entro com o valor "ab" no campo "Varchar Password Verify Verify"
      E eu entro com o valor "ab" no campo "Varchar Varchar"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 6 caracteres" no campo "Varchar Password Verify"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 6 caracteres" no campo "Varchar Password Verify Verify"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 3 caracteres" no campo "Varchar Varchar"
