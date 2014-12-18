#!/bin/bash

moduleAdmin="Paginas"
#php ./../../public/index.php gear project deploy development
#php ./../../public/index.php gear project setUpMysql --dbname="gear-pousada" --username="root" --password="gear"
php ./../../public/index.php gear module delete $moduleAdmin
php ./../../public/index.php gear module create $moduleAdmin
php ./../../public/index.php gear db create $moduleAdmin --table=InformacaoPrincipal  --columns="{\"meta_tags\": \"metatags\", \"meta_imagem\": \"uploadimagem\", \"meta_descricao\": \"metadata\", \"meta_titulo\": \"metadata\"}"
php ./../../public/index.php gear db create $moduleAdmin --table=Acomodacao --columns="{\"meta_tags\": \"metatags\", \"meta_imagem\": \"uploadimagem\", \"meta_descricao\": \"metadata\", \"meta_titulo\": \"metadata\"}"
php ./../../public/index.php gear db create $moduleAdmin --table=TipoAcomodacao --columns="{\"meta_tags\": \"metatags\", \"meta_imagem\": \"uploadimagem\", \"meta_descricao\": \"metadata\", \"meta_titulo\": \"metadata\"}"
##php ./../../public/index.php gear db create $moduleAdmin --table=Imagem
php ./../../public/index.php gear project setUpEntity $moduleAdmin --entity="Imagem"
php ./../../public/index.php gear build $moduleAdmin --trigger="dev"

#

#php ./../../public/index.php gear project setUpAcl