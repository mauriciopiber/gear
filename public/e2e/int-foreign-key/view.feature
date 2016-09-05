# language: pt

@my-module @int-foreign-key @int-foreign-key-view

Funcionalidade: Visualizar um Int Foreign Key cadastrado.

  Como Administrador, quero visualizar os dados de um Int Foreign Key cadastrado.

    @layout
    Cenário: Acesso a página de Visualizar Int Foreign Key.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      Quando eu clico no botão Visualizar no ítem ID "30"
      Então eu vejo o título "Visualizar Int Foreign Key - Admin PiberNetwork"
      E eu vejo o título central "Visualizar Int Foreign Key - 30"
      E eu vejo o breadscrumb "My Module / Int Foreign Key / Visualizar"
      E eu vejo o atributo "Dep Name" com o valor "30Dep Name"
      E eu vejo o botão de Voltar
      E eu vejo o botão de Novo
      E eu vejo o botão de Editar
      E eu vejo o botão de Excluir
