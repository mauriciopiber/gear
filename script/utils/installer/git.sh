#!/bin/bash
projectDir=${1}
projectGit=${2}

cd $projectDir

echo "
vendor/*
" > .gitignore

git init
git remote add origin $projectGit
git add .
git commit -am 'Iniciando projeto';
git push origin master
git branch -b desenvolvimento
git status

echo "Projeto $projectDir disponibilizado no git $projectGit"
echo -n "[OK***REMOVED***"