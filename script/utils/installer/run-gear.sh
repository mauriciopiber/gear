#!/bin/bash
projectDir=${1}

php $projectDir/public/index.php gear project deploy development

php $projectDir/public/index.php gear module load DoctrineModule --before=Gear
php $projectDir/public/index.php gear module load DoctrineORMModule --after=DoctrineModule
php $projectDir/public/index.php gear module load ZfcBase --after=DoctrineORMModule
php $projectDir/public/index.php gear module load ZfcUser --after=ZfcBase
php $projectDir/public/index.php gear module load ZfcUserDoctrineORM --after=ZfcUser
php $projectDir/public/index.php gear module load AssetManager --after=ZfcUserDoctrineORM
php $projectDir/public/index.php gear module load Security --after=Gear
php $projectDir/public/index.php gear module load ImagemUpload --after=ImagemUpload
php $projectDir/public/index.php gear module load GearAclUp --after=Gear
php $projectDir/public/index.php gear module load GearVersion --after=Gear

php $projectDir/public/index.php gear project setUpAcl --role --user
php $projectDir/public/index.php gear module load BjyAuthorize --before=ZfcBase
php $projectDir/public/index.php gear module load ZendDeveloperTools --after=DoctrineORMModule

chmod 777 -R $projectDir/data