
Construir Projeto

Comando que cria vários módulos para um projeto já existente.
Você escolhe se testa localmente ou apenas na CI.
Não é possível preparar a versão automaticamente ainda.

Outros: create, reset

vendor/bin/gear-project construct Exemplo $(pwd) "ModuloDeExemplo;web;estrutura.yml,20170101232323_banco.php" "1" "1"

projeto    -> Nome do Projeto que será criado.
scripts    -> Nome do diretório base onde estão os arquivos que serão copiados
modules    -> String no padrão ;| dos módulos que serão criados
test local -> 0 ou 1 para rodar os testes localmente.
test ci    -> 0 ou 1 para rodar os testes na integração contínua.
