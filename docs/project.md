# Gear\Project

## Comandos

### 1. Criar Projeto

---

    gear project create <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED*** --database= --username= --password= [--basepath=***REMOVED***
    
### 2. Deletar Projeto

---

    gear project delete <project> [--host=***REMOVED*** [--git=***REMOVED***  [--nfs***REMOVED*** --database= [--basepath=***REMOVED***
    
### 3. Fazer o Upgrade 

---

    gear project upgrade [--Y***REMOVED***
    
### 4. Diagnosticar erros

---

    gear project diagnostic
    
### 5. Inserir Fixtures no banco

---
 
    gear project fixture [--append***REMOVED*** [--reset-autoincrement***REMOVED***

### 6. Criar novo arquivo config

---

    gear project config --host= --dbname=  --username= --password= --environment= --dbms=
    
### 7. Criar arquivo global de configuração   

---
    
    gear project global --host= --dbname=  --dbms= --environment= 
    
### 8. Criar arquivo local de configuração

---
    
    gear project local --username= --password= 

### 9. Criar uma entrada nfs e reiniciar nfs-kernel-server

---
    
    gear project nfs
    
### 10. Criar virtual host para acessar pasta public

---
    
    gear project virtual-host <environment>
    
### 11. Adicionar projeto ao Git.

---
    
    gear project git <git>
    
### 12. Adicionar ao autoload do composer

---
    
    gear project dump-autoload