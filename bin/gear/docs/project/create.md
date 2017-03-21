
Criar Projeto

Comando que cria um novo projeto com toda estrutura necessária para começar o desenvolvimento de sistemas Gear e neutros.
Escolha se os testes são executados localmente, e/ou na integração contínua.
Escolha se quer lançar a versão inicial do projeto.

Outros: construct, reset

vendor/bin/gear-project create Exemplo $(pwd) "ModuloDeExemplo;web;estrutura.yml,20170101232323_banco.php" "1" "1" "1"

projeto    -> Nome do Projeto que será criado.
scripts    -> Nome do diretório base onde estão os arquivos que serão copiados
modules    -> String no padrão ;| dos módulos que serão criados
test local -> 0 ou 1 para rodar os testes localmente.
test ci    -> 0 ou 1 para rodar os testes na integração contínua.
version    -> 0 ou 1 se quiser criar a primeira versão no Jira.
