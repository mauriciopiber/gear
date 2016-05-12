# Gear\Database

## Comandos


### 1. Gerar arquivos para utilizar de Mock de tabela.

---

    gear database mock <module> <table>

### 2. Faz um diagnóstico no banco de dados para certificar que as tabelas estão corretas    

---    
    
    gear database analyse
    
### 3. Faz diagnóstico em uma tabela do banco    
    
---
    
    gear database analyse table <table>
    
### 4. Corrige as tabelas do banco de dados    

---

    gear database fix

### 5. Corrigir uma tabela do banco

---
    
    gear database fix table <table> [--no-truncate***REMOVED***

### 6. Limpar dados de uma tabela
    
---
    
    gear database clear table <table>

### 7. Resetar auto increment das tabelas
    
---
    
    gear database autoincrement
    
### 8. Resetar o auto incremente de todas tabelas    

---
    
    gear database autoincrement table <table>

### 9. Carrega um dump do banco de dados para o mysql    

---
    
    gear database load <location>

### 10. Cria o dump do banco de dados do sistema em um local específico
    
---
    
    gear database dump <location> [<name>***REMOVED***

### 11. Cria o dump do banco no local padrão dos testes para determinado módulo
    
---    

    gear database module dump <module>
   
### 12. Cria dump do banco de dados no local padrão do projeto

---

    gear database project dump