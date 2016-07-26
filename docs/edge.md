# Gear\Edge

O Gear tem como característica a rápida resposta à evolução, o edge serve como processo de organização dessas mudanças.


O Edge possui atualmente 5 componentes:

1. Composer
1. Ant
1. Npm
1. File
1. Dir

Cada tecnologia interfere de uma maneira característica na estrutura dos módulos e projetos.

Gulpfile, utilizado para concatenar os scripts de css e javascript, por exemplo, necessita da seguinte estrutura:

1. O arquivo gulpfile atualizado.
1. O arquivo data/config.js atualizado.
1. O package "gulp" na última versão estável.
1. O package "gulp-css" na última versão estável
1. Permissão para escrever na pasta public/dist

Então, cada tecnologia possui uma implicação específica nos módulos e projetos.


Como adicionar uma nova ferramenta ao projeto Gear?

## Teste unitário com xhprof.

1. Adicionar "lox/xhprof" : "dev-master" no require-dev composer
1. Adicionar "phpunit/test-listener-xhprof" : "dev-master" no require-dev composer
1. Adicionar arquivo 'test/phpunit-xhprof.xml'
1. Adicionar ant phpunit-xhprof.xml
1. Refatorar todos test/phpunit* para manter uma divisão correta entre todos.


Adicionar ao Gear Module

1. Criar Arquivo junto com módulo.



