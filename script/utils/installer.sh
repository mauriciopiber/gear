#!/bin/bash
scriptDir=${1}
baseDir=${2}
projectName=${3}
projectDir=${4}
projectHost=${5}
projectGit=${6}
database=${7}
username=${8}
password=${9}
projectNameUrl=${10}

/bin/sh ${1}/installer/composer.sh $baseDir $projectDir $projectName

/bin/sh ${1}/installer/database.sh $database $username $password
/bin/sh ${1}/installer/phinx.sh $projectDir $database $username $password
/bin/sh ${1}/installer/specification.sh $projectDir $projectNameUrl $database $username $password
/bin/sh ${1}/installer/copy-migration.sh $projectDir
/bin/sh ${1}/installer/run-migration.sh $projectDir

/bin/sh ${1}/installer/application.config.sh $projectDir
/bin/sh ${1}/installer/run-gear.sh $projectDir
/bin/sh ${1}/installer/virtualhost.sh $projectDir $projectHost

/bin/sh ${1}/installer/permission.sh $projectDir
/bin/sh ${1}/installer/jsmin.sh $projectDir $scriptDir
/bin/sh ${1}/installer/index.sh $projectDir
/bin/sh ${1}/installer/init_autoloader.sh $projectDir


/bin/sh ${1}/installer/nfs.sh $projectDir
/bin/sh ${1}/installer/git.sh $projectDir $projectGit


exit 1
