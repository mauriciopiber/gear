#!/bin/bash

projectDir=${1}

function createDir()
{
	dir=$1

	ls -l $dir &> /dev/null

	if [ "$dir" != 0 ***REMOVED***; then
		mkdir $dir
	fi

	chmod 777 -R $dir



}

function createGitIgnore()
{
	dir=$1
	echo "*" >> $dir/.gitignore
	echo "!.gitignore" >> $dir/.gitignore
}


createDir $projectDir/data
createDir $projectDir/data/logs
createGitIgnore $projectDir/data/logs
createDir $projectDir/data/cache
createDir $projectDir/data/cache/configcache
createGitIgnore $projectDir/data/cache/configcache
createDir $projectDir/data/DoctrineORMModule
createDir $projectDir/data/DoctrineORMModule/Proxy
createGitIgnore $projectDir/data/DoctrineORMModule/Proxy
createDir $projectDir/data/DoctrineModule
createDir $projectDir/data/DoctrineModule/cache
createGitIgnore $projectDir/data/DoctrineModule/cache
createDir $projectDir/public/upload
