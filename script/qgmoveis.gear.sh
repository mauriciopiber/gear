#!/bin/bash



moduleMain="Moveis"



moduleAdmin="Paginas"
php ./../../public/index.php gear module delete $moduleAdmin
php ./../../public/index.php gear module create $moduleAdmin
php ./../../public/index.php gear db create $moduleAdmin --table=Produto --columns="{\"destaque\": \"simple-checkbox\"}"
php ./../../public/index.php gear db create $moduleAdmin --table=Categoria
php ./../../public/index.php gear db create $moduleAdmin --table=InformacaoPrincipal
php ./../../public/index.php gear db create $moduleAdmin --table=InformacaoSobre
php ./../../public/index.php gear project setUpAcl
exit 1
#php ./../../public/index.php gear project setUpEntity $moduleAdmin --entity="Imagem"
exit 1



moduleAdmin="Tabacaria"
php ./../../public/index.php gear module delete $moduleAdmin
php ./../../public/index.php gear module create $moduleAdmin
php ./../../public/index.php gear db create $moduleAdmin --table=Cigarro
php ./../../public/index.php gear db create $moduleAdmin --table=Cor

exit 1

php ./../../public/index.php gear build $moduleAdmin --trigger="dev"



php ./../../public/index.php gear module delete $moduleMain
php ./../../public/index.php gear module create $moduleMain
php ./../../public/index.php gear controller create $moduleMain --name=MoveisController --object="%s\Controller\Moveis"
php ./../../public/index.php gear activity create $moduleMain MoveisController --role=guest --name=index --dependency="Service\Produto"
php ./../../public/index.php gear activity create $moduleMain MoveisController --role=guest --name=listar-produtos --dependency="Service\Categoria,Service\Produto"
php ./../../public/index.php gear activity create $moduleMain MoveisController --role=guest --name=produto --dependency="Service\Produto"
php ./../../public/index.php gear activity create $moduleMain MoveisController --role=guest --name=sobre --dependency="Service\Info"
php ./../../public/index.php gear activity create $moduleMain MoveisController --role=guest --name=contato --dependency="Service\Email"
php ./../../public/index.php gear project setUpAcl
php ./../../public/index.php gear build Moveis --trigger="dev"

exit 1

exit 1




exit 1

cat ./../AdminMoveis/src/AdminMoveis/Form/CategoriaForm.php
cat ./../AdminMoveis/src/AdminMoveis/Filter/CategoriaFilter.php
exit 1


exit 1
cat ./../AdminMoveis/schema/module.json
php ./../../public/index.php gear build AdminMoveis --trigger="dev"



exit 1





cat ./../AdminMoveis/src/AdminMoveis/Entity/InformacaoPrincipal.php

exit 1


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





