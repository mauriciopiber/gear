# language: pt

@my-module @all-columns-db-unique-not-null @all-columns-db-unique-not-null-create @create
Funcionalidade: Cadastrar novo All Columns Db Unique Not Null.

  Como Administrador, quero cadastrar um novo All Columns Db Unique Not Null.

    @layout
    Cenário: Acesso a página de Criar All Columns Db Unique Not Null pelo menu principal
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - All Columns Db Unique Not Null - Criar"
      Então eu vejo o título "Criar All Columns Db Unique Not Null - Admin PiberNetwork"
      E eu vejo o título central "Criar All Columns Db Unique Not Null"
      E eu vejo o breadscrumb "My Module / All Columns Db Unique Not Null / Criar"
      E eu vejo o botão de Salvar
      E eu vejo o botão de Voltar

    @tearDown @logValidation @form-success
    Cenário: Acesso a página de Criar All Columns Db Unique Not Null.
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - All Columns Db Unique Not Null - Criar"
      E eu entro com o valor "55VarcharPasswordVer" no campo "Varchar Password Verify Unique Not Null"
      E eu entro com o valor "55VarcharPasswordVer" no campo "Varchar Password Verify Unique Not Null Verify"
      E eu entro com uma imagem no campo "Varchar Upload Image Unique Not Null"
      E eu entro com o valor "varchar.url.unique.not.null55.com.br" no campo "Varchar Url Unique Not Null"
      E eu entro com o valor "55Varchar Varchar Unique Not Null" no campo "Varchar Varchar Unique Not Null"
      E eu entro com o valor "(51) 9999-9955" no campo "Varchar Telephone Unique Not Null"
      E eu entro com o valor "varchar.email.unique.not.null55@gmail.com" no campo "Varchar Email Unique Not Null"
      E eu entro com o valor "2009-07-25" no campo "Date Date Unique Not Null"
      E eu entro com o valor "25/07/2009" no campo "Date Date Pt Br Unique Not Null"
      E eu entro com o valor "2009-07-25 07:00:55" no campo "Datetime Datetime Unique Not Null"
      E eu entro com o valor "25/07/2009 07:00:55" no campo "Datetime Datetime Pt Br Unique Not Null"
      E eu entro com o valor "07:00:55" no campo "Time Time Unique Not Null"
      E eu entro com o valor "55.55" no campo "Decimal Decimal Unique Not Null"
      E eu entro com o valor "R$ 55,55" no campo "Decimal Money Pt Br Unique Not Null"
      E eu entro com o valor "55" no campo "Int Int Unique Not Null"
      E eu marco a caixa de escolha "Int Checkbox Unique Not Null"
      E eu escolho o valor "25Dep Name" na caixa para selecionar "Int Foreign Key Unique Not Null"
      E eu marco a caixa de escolha "Boolean Int Unique Not Null"
      E eu marco a caixa de escolha "Boolean Checkbox Unique Not Null"
      E eu entro com o texto "55Text Text Unique Not Null" no campo "Text Text Unique Not Null"
      E eu entro com o texto "55Text Html Unique Not Null" no campo html "Text Html Unique Not Null"
      E eu clico no botão Salvar
      Então eu vejo a mensagem que foi "Sucesso! Os dados foram salvos corretamente."
      E eu vejo o valor "" no campo "Varchar Password Verify Unique Not Null"
      E eu vejo o valor "" no campo "Varchar Password Verify Unique Not Null Verify"
      E eu vejo a imagem "/upload/all-columns-db-unique-not-null-varcharUploadImageUniqueNotNull/prefake-image.png" no campo "Varchar Upload Image Unique Not Null"
      E eu vejo o valor "varchar.url.unique.not.null55.com.br" no campo "Varchar Url Unique Not Null"
      E eu vejo o valor "55Varchar Varchar Unique Not Null" no campo "Varchar Varchar Unique Not Null"
      E eu vejo o valor "(51) 9999-9955" no campo "Varchar Telephone Unique Not Null"
      E eu vejo o valor "varchar.email.unique.not.null55@gmail.com" no campo "Varchar Email Unique Not Null"
      E eu vejo o valor "2009-07-25" no campo "Date Date Unique Not Null"
      E eu vejo o valor "25/07/2009" no campo "Date Date Pt Br Unique Not Null"
      E eu vejo o valor "2009-07-25 07:00:55" no campo "Datetime Datetime Unique Not Null"
      E eu vejo o valor "25/07/2009 07:00:55" no campo "Datetime Datetime Pt Br Unique Not Null"
      E eu vejo o valor "07:00:55" no campo "Time Time Unique Not Null"
      E eu vejo o valor "55.55" no campo "Decimal Decimal Unique Not Null"
      E eu vejo o valor "R$ 55,55" no campo "Decimal Money Pt Br Unique Not Null"
      E eu vejo o valor "55" no campo "Int Int Unique Not Null"
      E eu vejo marcada a caixa de escolha "Int Checkbox Unique Not Null"
      E eu vejo escolhido "25Dep Name" na caixa para selecionar "Int Foreign Key Unique Not Null"
      E eu vejo marcada a caixa de escolha "Boolean Int Unique Not Null"
      E eu vejo marcada a caixa de escolha "Boolean Checkbox Unique Not Null"
      E eu vejo texto "55Text Text Unique Not Null" no campo "Text Text Unique Not Null"
      E eu vejo texto "55Text Html Unique Not Null" no campo html "Text Html Unique Not Null"

    @tearDown @form-validate-null
    Cenário: Crio All Columns Db Unique Not Null com os campos em banco
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - All Columns Db Unique Not Null - Criar"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Varchar Url Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Varchar Varchar Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Varchar Telephone Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Varchar Email Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Date Date Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Date Date Pt Br Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Datetime Datetime Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Datetime Datetime Pt Br Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Time Time Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Decimal Decimal Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Int Int Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Int Foreign Key Unique Not Null"

    @form-validate-invalid
    Cenário: Crio All Columns Db Unique Not Null com formatos inválidos
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Unique Not Null - Criar"
      E eu entro com o valor "ABCDEF" no campo "Varchar Url Unique Not Null"
      E eu entro com o valor "ABCDEF" no campo "Varchar Telephone Unique Not Null"
      E eu entro com o valor "ABCDEF" no campo "Varchar Email Unique Not Null"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Url Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Telephone Unique Not Null"
      E eu vejo a o aviso de validação que "O valor é inválido" no campo "Varchar Email Unique Not Null"

    @form-validate-max
    Cenário: Crio All Columns Db Unique Not Null com valores com numero de caracteres acima do permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Unique Not Null - Criar"
      E eu entro com o valor "abcdefghijklmnopqrstu" no campo "Varchar Password Verify Unique Not Null"
      E eu entro com o valor "abcdefghijklmnopqrstu" no campo "Varchar Password Verify Unique Not Null Verify"
      E eu entro com o valor "abcdefghijklmnopqrstujxywzabcdefghijklmnopqrst" no campo "Varchar Varchar Unique Not Null"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 20 caracteres" no campo "Varchar Password Verify Unique Not Null"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 20 caracteres" no campo "Varchar Password Verify Unique Not Null Verify"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 45 caracteres" no campo "Varchar Varchar Unique Not Null"

    @form-validate-min
    Cenário: Crio All Columns Db Unique Not Null com valores com numero de caracteres menor que o permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Unique Not Null - Criar"
      E eu entro com o valor "ab" no campo "Varchar Password Verify Unique Not Null"
      E eu entro com o valor "ab" no campo "Varchar Password Verify Unique Not Null Verify"
      E eu entro com o valor "ab" no campo "Varchar Varchar Unique Not Null"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 6 caracteres" no campo "Varchar Password Verify Unique Not Null"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 6 caracteres" no campo "Varchar Password Verify Unique Not Null Verify"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 3 caracteres" no campo "Varchar Varchar Unique Not Null"

    @form-validate-unique
    Cenário: Crio All Columns Db Unique Not Null com valores já utilizados em outros ítens
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Unique Not Null - Criar"
      E eu entro com o valor "varchar.url.unique.not.null30.com.br" no campo "Varchar Url Unique Not Null"
      E eu entro com o valor "30Varchar Varchar Unique Not Null" no campo "Varchar Varchar Unique Not Null"
      E eu entro com o valor "(51) 9999-9930" no campo "Varchar Telephone Unique Not Null"
      E eu entro com o valor "varchar.email.unique.not.null30@gmail.com" no campo "Varchar Email Unique Not Null"
      E eu entro com o valor "2007-06-30" no campo "Date Date Unique Not Null"
      E eu entro com o valor "2007-06-30 06:00:30" no campo "Datetime Datetime Unique Not Null"
      E eu entro com o valor "06:00:30" no campo "Time Time Unique Not Null"
      E eu entro com o valor "30.30" no campo "Decimal Decimal Unique Not Null"
      E eu entro com o valor "30" no campo "Int Int Unique Not Null"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Varchar Url Unique Not Null"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Varchar Varchar Unique Not Null"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Varchar Telephone Unique Not Null"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Varchar Email Unique Not Null"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Date Date Unique Not Null"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Datetime Datetime Unique Not Null"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Time Time Unique Not Null"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Decimal Decimal Unique Not Null"
      E eu vejo a o aviso de validação que "Valor já está sendo utilizado" no campo "Int Int Unique Not Null"
