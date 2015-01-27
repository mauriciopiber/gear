#!/bin/bash
php ../../public/index.php gear unload BjyAuthorize
php ../../public/index.php gear module delete Teste
php ../../public/index.php gear module create Teste

php ../../public/index.php gear src create Teste --type="Entity" --name="User" --db="User"
php ../../public/index.php gear src create Teste --type="Entity" --name="Role" --db="Role"
php ../../public/index.php gear src create Teste --type="Entity" --name="StatusCusto" --db="StatusCusto"
php ../../public/index.php gear src create Teste --type="Entity" --name="GrupoCusto" --db="GrupoCusto"
php ../../public/index.php gear src create Teste --type="Entity" --name="TipoCusto" --db="TipoCusto"
php ../../public/index.php gear src create Teste --type="Entity" --name="Custo" --db="Custo"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="StatusCusto" --db="StatusCusto"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="GrupoCusto" --db="GrupoCusto"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="TipoCusto" --db="TipoCusto"
php ./../../public/index.php gear src create Teste --type="Fixture" --name="Custo" --db="Custo"

php ../../public/index.php gear project resetAcl
php ../../public/index.php gear autoincrement-database
../../vendor/bin/doctrine-module data-fixture:import