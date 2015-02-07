#!/bin/bash
scriptDir=${1}
baseDir=${2}
projectName=${3}
projectDir=${4}
projectHost=${5}
projectGit=${6}

/bin/sh ${1}/installer/composer.sh $baseDir $projectDir $projectName
/bin/sh ${1}/installer/application.config.sh $projectDir
/bin/sh ${1}/installer/virtualhost.sh $projectDir $projectHost
/bin/sh ${1}/installer/git.sh $projectDir $projectGit
/bin/sh ${1}/installer/nfs.sh $projectDir