#!/bin/bash
projectDir=${1}
projectGit=${2}

cd $projectDir

echo "
vendor/*
composer.phar
.buildpath
.project
" > .gitignore

git init
git remote add origin $projectGit
git checkout -b development
git add .
git commit -am "Iniciando projeto $projectGit";
git push origin development

echo "Projeto $projectDir disponibilizado no git $projectGit"
echo -n "[OK***REMOVED***"