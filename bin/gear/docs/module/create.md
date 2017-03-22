
Criar Módulo standalone

Comando que cria um novo módulo standalone toda estrutura necessária para começar o desenvolvimento de sistemas Gear e neutros.
Escolha se os testes são executados localmente, e/ou na integração contínua.
Escolha se quer lançar a versão inicial do projeto.

Outros: construct, reset

vendor/bin/gear-module create Exemplo "web" $(pwd) "estrutura.yml" "20170101232323_banco.php" "1" "1" "1"

modulo    -> Nome do Módulo que será criado.
tipo      -> Tipo de Módulo que será criado.
scriptDir -> Diretório onde estão os arquivos
gearfile  -> Nome do arquivo gearfile que será usado no novo módulo.
migration -> Nome do migration que será usado no novo módulo.
local     -> 0 ou 1 para rodar os testes localmente.
ci        -> 0 ou 1 para rodar os testes na integração contínua.
version   -> 0 ou 1 se quiser criar a primeira versão no Jira.
