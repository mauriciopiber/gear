
Construir Módulo em um Projeto

Comando que cria um módulo dentro de um projeto já existente.
Você escolhe se testa localmente ou apenas na CI.
Não é possível preparar a versão automaticamente ainda.

Outros: create, reset

vendor/bin/gear-project-module construct Exemplo $(pwd) "ModuloDeExemplo" "web" "estrutura.yml" "20170101232323_banco.php" "1" "1"

projeto    -> Nome do Projeto que será criado.
scripts    -> Nome do diretório base onde estão os arquivos que serão copiados
modulo     -> Nome do módulo que será construido
gear file  -> Nome do arquivo gearfile que será copiado.
migration  -> Nome do migration que será copiado.
test local -> 0 ou 1 para rodar os testes localmente.
test ci    -> 0 ou 1 para rodar os testes na integração contínua.
