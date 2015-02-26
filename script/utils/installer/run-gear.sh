#!/bin/bash
projectDir=${1}

php $projectDir/public/index.php gear project deploy development
php $projectDir/public/index.php gear project setUpAcl --role --user
php $projectDir/public/index.php gear module load BjyAuthorize --before=ZfcBase
php $projectDir/public/index.php gear module load Security --after=Gear
php $projectDir/public/index.php gear module load ImagemUpload --after=Security
