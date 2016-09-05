# language: pt

@my-module @all-columns-db-not-null @all-columns-db-not-null-delete

Funcionalidade: Deletar All Columns Db Not Null existente.

  Como Administrador, quero deletar um All Columns Db Not Null já existente.

    @tearDown @all-columns-db-not-null-fixture
    Cenário: Acesso a página de listar e Deleto All Columns Db Not Null.

      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db Not Null - Listar"
      E eu vejo "10" ítens cadastrados
      E eu vejo o ítem ID "75" na linha "1"
      Quando eu clico no botão Remover do ítem ID "75"
      E eu clico em Deletar
      Então eu vejo a mensagem confirmando "Sucesso! All Columns Db Not Null #75 excluído."
      E eu não vejo o ítem ID "75" na linha "1"
