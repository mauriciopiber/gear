# Componente Gear\Module\Mvc



## Filtro Mvc\Filter e Filtro Spec\Feature\Feature

Os 2 filtros devem trabalhar em harmonia. As mensagens de validação de ambos devem ser as mesmas.

Isso garante que a validação está informando mensagens positivas, criadas por psicólogos, e não por programadores.

Para cada coluna, é verificado as seguintes regras:

1. A coluna é nullable = false? Então adiciona validação de Campos obrigatórios.
2. A coluna é varchar? Então adiciona validação de tamanho mínimo e máximo.
3. A coluna possui um filtro específico como Formato? Mascara? Então adivinha uma validação pro formato do campo.

Os testes são escritos de maneira linear, é criado um cenário pra cada tipo específico.

@TODO Aqui está a grande questão de mudar o código de Imperativo pra Declarativo, a única tranquilidade é de que pra passar isso de nível está tudo bem testado.

1. Teste de campo obrigatório.
1. Teste de campo inválido.
1. Teste de tamanho máximo do campo.
1. Teste de tamanho mínimo do mínimo.
1. Teste de valor único no campo.


Essa mesma estrutura será utilizada para criar a Validação Javascript utilizando AngularJS.

Essa atualização será relizada em [GP-71***REMOVED***(https://pibernetwork.atlassian.net/browse/GP-71) e [GP-70***REMOVED***(https://pibernetwork.atlassian.net/browse/GP-70)







## Interfaces de Colunas.

Há uma característica marcante no Mvc que é a inclusão de código dentro do Mvc padrão dependendo da coluna.

É uma porta aberta para códigos que precisam ser executados na Service ou para preparar os dados para exibição no Controller.

Há colunas específicas que precisam de códigos específicos apenas em um lugar, é possível ter liberdade e agir conforme a necessidade.

**Evitar** a necessidade de interfaces de colunas, mas usar conforme necessário.


| Nome da Interface | Src Alvo | Método | Descrição |
|:--|:--|:--|:--|
 