
Resetar Projeto

Remove todos módulos passados como parametro.
Não remove todos módulos, apenas os passados como parámetro.

Outros: create, construct

vendor/bin/gear-project reset Exemplo "ModuloDeExemplo;ModuloDeTeste;ModuloDeIntegração" "1" "1"

projeto    -> Nome do Projeto que será criado.
modules    -> String no padrão ;| dos módulos que serão criados.
test local -> 0 ou 1 para rodar os testes localmente.
test ci    -> 0 ou 1 para rodar os testes na integração contínua.
