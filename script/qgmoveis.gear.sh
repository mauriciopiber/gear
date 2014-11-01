#!/bin/bash

moduleMain="Moveis"
moduleAdmin="AdminMoveis"
php ./../../public/index.php gear module delete $moduleAdmin
php ./../../public/index.php gear module create $moduleAdmin
php ./../../public/index.php gear db create $moduleAdmin --table=InformacaoPrincipal
php ./../../public/index.php gear db create $moduleAdmin --table=InformacaoSobre
php ./../../public/index.php gear db create $moduleAdmin --table=Categoria
php ./../../public/index.php gear db create $moduleAdmin --table=Produto
cat ./../AdminMoveis/schema/module.json
exit 1;
php ./../../public/index.php gear build AdminMoveis --trigger="dev"

cat ./../AdminMoveis/src/AdminMoveis/Entity/InformacaoPrincipal.php

exit 1

php ./../../public/index.php gear module delete $moduleMain
php ./../../public/index.php gear module create $moduleMain
php ./../../public/index.php gear controller create $moduleMain --name=MoveisController --object="%s\Controller\Moveis"
php ./../../public/index.php gear activity create $moduleMain MoveisController --name=index --dependency="Service\Produto"
php ./../../public/index.php gear activity create $moduleMain MoveisController --name=listar-produtos --dependency="Service\Categoria,Service\Produto"
php ./../../public/index.php gear activity create $moduleMain MoveisController --name=produto --dependency="Service\Produto"
php ./../../public/index.php gear activity create $moduleMain MoveisController --name=sobre --dependency="Service\Info"
php ./../../public/index.php gear activity create $moduleMain MoveisController --name=contato --dependency="Service\Email"
php ./../../public/index.php gear build Moveis --trigger="dev"
exit 1

php ./../../public/index.php gear src create $moduleMain --type="Repository" --name="Produto"
php ./../../public/index.php gear src create $moduleMain --type="Service" --name="Produto" --dependency="Repository\Produto"
php ./../../public/index.php gear src create $moduleMain --type="Repository" --name="Categoria"
php ./../../public/index.php gear src create $moduleMain --type="Repository" --name="InformacaoPrincipal"
php ./../../public/index.php gear src create $moduleMain --type="Repository" --name="InformacaoSobre"
php ./../../public/index.php gear src create $moduleMain --type="Service" --name="Categoria" --dependency="Repository\Categoria"
php ./../../public/index.php gear src create $moduleMain --type="Service" --name="InformacaoPrincipal" --dependency="Repository\InformacaoPrincipal"
php ./../../public/index.php gear src create $moduleMain --type="Service" --name="InformacaoSobre" --dependency="Repository\InformacaoSobre"


exit 1

echo "Linha do Tempo !"








exit 1



exit 1;





