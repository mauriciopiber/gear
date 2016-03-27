#!/bin/bash
projectDir=${1}

mkdir $projectDir/data/migrations

cp -a $projectDir/vendor/mauriciopiber/${x}gear-admin/migrations/. $projectDir/data/migrations/
cp -a $projectDir/vendor/mauriciopiber/${x}gear-image/migrations/. $projectDir/data/migrations/

