# language: pt

@my-module @int-foreign-key @int-foreign-key-delete

Funcionalidade: Deletar Int Foreign Key existente.

  Como Administrador, quero deletar um Int Foreign Key já existente.

    @tearDown @int-foreign-key-fixture
    Cenário: Acesso a página de listar e Deleto Int Foreign Key.

      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - Int Foreign Key - Listar"
      E eu vejo "10" ítens cadastrados
      E eu vejo o ítem ID "75" na linha "1"
      Quando eu clico no botão Remover do ítem ID "75"
      E eu clico em Deletar
      Então eu vejo a mensagem confirmando "Sucesso! Int Foreign Key #75 excluído."
      E eu não vejo o ítem ID "75" na linha "1"
