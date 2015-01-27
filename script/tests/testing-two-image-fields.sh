#!/bin/bash

moduleAdmin="PaginasQgmoveis"
php ./../../public/index.php gear module delete $moduleAdmin
php ./../../public/index.php gear module create $moduleAdmin
php ./../../public/index.php gear db create $moduleAdmin --table=InformacaoPrincipal  --columns="{\"imagem_direita\": \"metaimagem\", \"imagem_esquerda\": \"metaimagem\"}"
php ./../../public/index.php gear db create $moduleAdmin --table=Categoria
php ./../../public/index.php gear db create $moduleAdmin --table=InformacaoSobre
php ./../../public/index.php gear db create $moduleAdmin --table=Fornecedor
php ./../../public/index.php gear db create $moduleAdmin --table=Produto --columns="{\"destaque\": \"simple-checkbox\"}"
php ./../../public/index.php gear project setUpEntity $moduleAdmin --entity="Imagem"