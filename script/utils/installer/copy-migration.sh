#!/bin/bash
projectDir=${1}

mkdir $projectDir/migrations

cp -a $projectDir/vendor/mauriciopiber/${x}minimal-admin/migrations/. $projectDir/migrations/
cp -a $projectDir/vendor/mauriciopiber/${x}image-upload/migrations/. $projectDir/migrations/

