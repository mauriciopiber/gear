
Criar Módulo standalone

Comando que cria um novo módulo standalone toda estrutura necessária para começar o desenvolvimento de sistemas Gear e neutros.
Escolha se os testes são executados localmente, e/ou na integração contínua.
Escolha se quer lançar a versão inicial do projeto.

Outros: construct, reset

vendor/bin/gear-module create Exemplo "web" "estrutura.yml" "20170101232323_banco.php" $(pwd) "1" "1" "1"

modulo     -> Nome do Projeto que será criado.
tipo       -> Tipo do Módulo
gear file  -> Nome do arquivo gearfile que será copiado.
migration  -> Nome do migration que será copiado.
test local -> 0 ou 1 para rodar os testes localmente.
test ci    -> 0 ou 1 para rodar os testes na integração contínua.
version    -> 0 ou 1 se quiser criar a primeira versão no Jira.
