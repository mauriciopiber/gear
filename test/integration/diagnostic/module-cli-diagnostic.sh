#!/bin/bash

base="/var/www/gear-package"
modulepath="$base/my-module-cli"
module="MyModuleCli"

function clean() 
{
    modulepath=${1}
    rm $modulepath/build.xml
    rm $modulepath/test/ant-*
    rm $modulepath/composer.json
    rm -R $modulepath/data/logs
    rm -R $modulepath/data/session
    rm -R $modulepath/data/cache
    rm -R $modulepath/data/DoctrineModule
    rm -R $modulepath/data/DoctrineORMModule
    rm -R $modulepath/data/migrations
    rm $modulepath/README.md
    rm $modulepath/mkdocs.yml
    rm $modulepath/docs/index.md
    rm $modulepath/phpdox.xml
    rm $modulepath/phinx.yml
    rm $modulepath/script/deploy-testing.sh
    rm $modulepath/script/deploy-development.sh
    rm $modulepath/script/load.sh
    rm $modulepath/Jenkinsfile
    rm $modulepath/.gitignore
    rm $modulepath/codeception.yml
    rm $modulepath/test/unit.suite.yml
    rm $modulepath/test/phpmd.xml
    rm $modulepath/test/phpcs-docs.xml
    rm $modulepath/test/phpunit-benchmark.xml
    rm $modulepath/test/phpunit-coverage-benchmark.xml
    rm $modulepath/schema/module.json

}


ls -l $modulepath/schema/module.json &> /dev/null

if [ "${?}" == 0 ***REMOVED***; then
    rm $modulepath/schema/module.json
fi

php public/index.php gear module-as-project create $module $base --type=cli --force

cd $modulepath && script/deploy-development.sh

cd $modulepath && php public/index.php gear module diagnostic $module $base --type=cli

clean $modulepath

cd $modulepath && php public/index.php gear module diagnostic $module $base --type=cli

cd $modulepath && php public/index.php gear module upgrade $module $base --type=cli --force

cd $modulepath && php public/index.php gear module diagnostic $module $base --type=cli
