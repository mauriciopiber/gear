
Resetar Módulo standalone

Comando que reseta o módulo.
Escolha se os testes são executados localmente, e/ou na integração contínua.
Escolha se quer lançar a versão inicial do projeto.

Outros: construct, create

vendor/bin/gear-module reset Exemplo "1" "1"

modulo     -> Nome do Projeto que será criado.
test ci    -> 0 ou 1 para rodar os testes na integração contínua.
version    -> 0 ou 1 se quiser criar a primeira versão no Jira.
