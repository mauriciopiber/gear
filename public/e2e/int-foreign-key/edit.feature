# language: pt

@my-module @int-foreign-key @int-foreign-key-edit @edit

Funcionalidade: Editar Int Foreign Key existente.

  Como Administrador, quero editar um Int Foreign Key já existente.

    @layout
    Cenário: Editar Int Foreign Key com sucesso.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      E eu vejo o título "Editar Int Foreign Key - Admin PiberNetwork"
      E eu vejo o título central "Editar Int Foreign Key - 30"
      E eu vejo o breadscrumb "My Module / Int Foreign Key / Editar"
      E eu vejo o botão de Salvar
      E eu vejo o botão de Voltar
      E eu vejo o botão de Visualizar
      E eu vejo o botão de Criar

    @tearDown @int-foreign-key-fixture @logValidation
    Cenário: Editar Int Foreign Key com sucesso.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Listar"
      E eu vejo o ítem ID "75" na linha "1"
      E eu clico no botão Editar no ítem ID "75"
      E eu vejo o valor "75Dep Name" no campo "Dep Name"
      Quando eu entro com o valor "55Dep Name" no campo "Dep Name"
      E eu clico no botão Salvar
      Então eu vejo a mensagem que foi "Sucesso! Os dados foram salvos corretamente."
      E eu vejo o valor "55Dep Name" no campo "Dep Name"

    @form-validate-null
    Cenário: Edito Int Foreign Key com os campos em branco
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      Quando eu limpo os campos
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Dep Name"


    @form-validate-max
    Cenário: Edito Int Foreign Key com valores com numero de caracteres acima do permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      E eu entro com o valor "abcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstuj" no campo "Dep Name"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 255 caracteres" no campo "Dep Name"

    @form-validate-min
    Cenário: Edito Int Foreign Key com valores com numero de caracteres menor que o permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      E eu clico no botão Editar no ítem ID "30"
      E eu entro com o valor "ab" no campo "Dep Name"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 3 caracteres" no campo "Dep Name"
