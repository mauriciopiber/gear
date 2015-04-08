#!/bin/bash
projectDir=${1}

mkdir $projectDir/data/migrations

cp -a $projectDir/vendor/mauriciopiber/${x}minimal-admin/migrations/. $projectDir/data/migrations/
cp -a $projectDir/vendor/mauriciopiber/${x}image-upload/migrations/. $projectDir/data/migrations/

