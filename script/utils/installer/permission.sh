#!/bin/bash

projectDir=${1}

function createDir()
{
	ls -l $1 &> /dev/null

	if [ "$?" != 0 ***REMOVED***; then
		mkdir $1
	fi

	chmod 777 -R $1
}

createDir $projectDir/data
createDir $projectDir/data/logs
createDir $projectDir/data/cache
createDir $projectDir/data/cache/configcache
createDir $projectDir/data/DoctrineORMModule
createDir $projectDir/data/DoctrineORMModule/Proxy
createDir $projectDir/data/DoctrineModule
createDir $projectDir/data/DoctrineModule/cache
createDir $projectDir/public/upload
