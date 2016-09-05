# language: pt

@my-module @int-foreign-key @int-foreign-key-create @create
Funcionalidade: Cadastrar novo Int Foreign Key.

  Como Administrador, quero cadastrar um novo Int Foreign Key.

    @layout
    Cenário: Acesso a página de Criar Int Foreign Key pelo menu principal
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - Int Foreign Key - Criar"
      Então eu vejo o título "Criar Int Foreign Key - Admin PiberNetwork"
      E eu vejo o título central "Criar Int Foreign Key"
      E eu vejo o breadscrumb "My Module / Int Foreign Key / Criar"
      E eu vejo o botão de Salvar
      E eu vejo o botão de Voltar

    @tearDown @logValidation @form-success
    Cenário: Acesso a página de Criar Int Foreign Key.
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - Int Foreign Key - Criar"
      E eu entro com o valor "55Dep Name" no campo "Dep Name"
      E eu clico no botão Salvar
      Então eu vejo a mensagem que foi "Sucesso! Os dados foram salvos corretamente."
      E eu vejo o valor "55Dep Name" no campo "Dep Name"

    @tearDown @form-validate-null
    Cenário: Crio Int Foreign Key com os campos em banco
      Dado que eu estou logado na página principal
      Quando eu clico no menu "My Module - Int Foreign Key - Criar"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor é obrigatório e não pode estar vazio" no campo "Dep Name"

    @form-validate-invalid
    Cenário: Crio Int Foreign Key com formatos inválidos
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Criar"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"

    @form-validate-max
    Cenário: Crio Int Foreign Key com valores com numero de caracteres acima do permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Criar"
      E eu entro com o valor "abcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstujxywzabcdefghijklmnopqrstuj" no campo "Dep Name"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no máximo 255 caracteres" no campo "Dep Name"

    @form-validate-min
    Cenário: Crio Int Foreign Key com valores com numero de caracteres menor que o permitido.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Criar"
      E eu entro com o valor "ab" no campo "Dep Name"
      E eu clico no botão Salvar
      Então eu vejo o alerta com a mensagem  "Ops! Verificar a validação dos campos para continuar"
      E eu vejo a o aviso de validação que "O valor deve ter no mínimo 3 caracteres" no campo "Dep Name"
