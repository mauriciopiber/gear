
Construir Módulo em um Projeto

Comando que cria um módulo dentro de um projeto já existente.
Você escolhe se testa localmente ou apenas na CI.
Não é possível preparar a versão automaticamente ainda.

Outros: create, reset

vendor/bin/gear-project-module reset Exemplo "ModuloDeExemplo" "1" "1"

projeto    -> Nome do Projeto que será criado.
modulo     -> Nome do módulo que será resetado
test local -> 0 ou 1 para rodar os testes localmente.
test ci    -> 0 ou 1 para rodar os testes na integração contínua.
