#!/bin/bash
projectDir=${1}
projectGit=${2}

cd $projectDir

echo "
vendor/*
data/DoctrineModule/cache/*
data/DoctrineORMModule/Proxy/*
data/cache/configcache/*
data/logs/*
build/*
composer.phar
.buildpath
.project
" > .gitignore

git init
git remote add origin $projectGit
git add .
git commit -am "Iniciando projeto $projectGit";
git push origin master

echo "Projeto $projectDir disponibilizado no git $projectGit"
echo -n "[OK***REMOVED***"