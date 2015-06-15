#!/bin/bash

base="/var/www/html/modules"
index="$base/public/index.php"

module=Trend
moduleUrl="trend"

php $index gear module unload TrendNatural
php $index gear module unload BjyAuthorize

php $index gear module delete $module
php $index gear module create $module

#controller Cliente.
#controller Produto.
#controller Pedido

php $index gear module controller create $module --name="ClienteController" --object="%s\Controller\Cliente"
php $index gear module activity create $module ClienteController --name="Login"
php $index gear module activity create $module ClienteController --name="AlterarDados"
php $index gear module activity create $module ClienteController --name="RecuperarSenha"
php $index gear module activity create $module ClienteController --name="EnvirRecuperarSenha"
php $index gear module activity create $module ClienteController --name="LinkInvalido"

php $index gear module controller create $module --name="ProdutoController" --object="%s\Controller\Produto"
php $index gear module activity create $module ProdutoController --name="Catalogo"

php $index gear module controller create $module --name="PedidoController" --object="%s\Controller\Pedido"
php $index gear module activity create $module PedidoController --name="ListarPedidos"
php $index gear module activity create $module PedidoController --name="Finalizar"
php $index gear module activity create $module PedidoController --name="Finalizado"
