# Gear - Mvc - Spec 


Quais as regras que devem ter em cada Spec?

---

## Criar

Background

Dado que eu estou na página principal e logado

Quando eu acesso o menu ""


### Acessa a página de Criar.

Então eu vejo os campos do form

E eu vejo o título da página

E eu vejo o breadscrumb ""

E eu vejo o botão de voltar

E eu vejo o botão de salvar


### Cria um usuário com sucesso.

Dado que eu estou na página principal e logado

Quando eu acesso o menu ""

E eu digito os dados corretamente

E eu clico em salvar

Então eu vejo os dados corretamente
 
E eu vejo a mensagem que os dados foram salvos com sucesso.


### Cria um usuário com campos inválidos e vê as mensagens de validação 

Quando eu digito um campo inválido

Então eu vejo os dados de validação dos campos inválidos
