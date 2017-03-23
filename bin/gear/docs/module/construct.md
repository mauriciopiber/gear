
Construir Módulo standalone

Comando que cria um novo módulo standalone toda estrutura necessária para começar o desenvolvimento de sistemas Gear e neutros.
Escolha se os testes são executados localmente, e/ou na integração contínua.
Escolha se quer lançar a versão inicial do projeto.

Outros: create, reset

vendor/bin/gear-module construct Exemplo "estrutura.yml" "20170101232323_banco.php" $(pwd) "1" "1"

modulo     -> Nome do Projeto que será criado.
scriptsDir -> Localização dos scripts.
gearfile   -> Nome do arquivo gearfile que será copiado.
migrations -> Nome do migration que será copiado.
local      -> 0 ou 1 para rodar os testes localmente.
ci         -> 0 ou 1 para rodar os testes na integração contínua.
