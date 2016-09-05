# language: pt

@my-module @index
Funcionalidade: Acessar a ação inicial do módulo My Module

  Como administrador, quero acessar a página inicial do módulo, pra ver em qual versão ele foi criado.

  Cenário: Acesso o módulo

    Dado que eu estou logado
    E que estou na página principal
    Quando eu clico no menu My Module
    Então eu vejo o título "Bem vindo ao módulo My Module - Admin PiberNetwork"
    E eu vejo o título central "Bem vindo ao módulo My Module"
    E eu vejo o breadscrumb começar com "My Module"