# language: pt

@my-module @all-columns-db @all-columns-db-upload-image @upload-image

Funcionalidade: Visualizar imagens cadastradas em um All Columns Db.

  Como Administrador, quero visualizar as imagens de um All Columns Db.

    @layout-now2
    Cenário: Acesso a página de Visualizar Imagens em All Columns Db.
      Dado que eu estou logado na página principal
      E eu clico no menu "My Module - All Columns Db - Listar"
      E eu vejo o ítem ID "30" na linha "1"
      Quando eu clico no botão Editar no ítem ID "30"
      E eu clico no botão "Editar Imagens"
      Então eu vejo "3" imagens cadastradas.
