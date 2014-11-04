#!/bin/bash
moduleAdmin=ImagemUpload
php ./../../public/index.php gear module delete $moduleAdmin
php ./../../public/index.php gear module create $moduleAdmin
php ./../../public/index.php gear project setUpEntity $moduleAdmin --entity="Imagem"
exit 1
php ./../../public/index.php gear src create $moduleAdmin --type="Repository" --name="ImagemRepository"
php ./../../public/index.php gear src create $moduleAdmin --type="Service" --name="ImagemService" --dependency="Repository\Imagem"
php ./../../public/index.php gear controller create $moduleAdmin --name=ImagemController --object="%s\Controller\Imagem"
php ./../../public/index.php gear activity create $moduleAdmin ImagemController --role=guest --name=listar-imagem --dependency="Service\Imagem"
php ./../../public/index.php gear activity create $moduleAdmin ImagemController --role=guest --name=excluir-imagem --dependency="Service\Imagem"
php ./../../public/index.php gear activity create $moduleAdmin ImagemController --role=guest --name=salvar-imagem --dependency="Service\Imagem"
php ./../../public/index.php gear build $moduleAdmin --trigger="dev"
exit 1


