#!/bin/bash

base="/var/www/gear-package"
modulepath="$base/my-module"

function clean() 
{
    modulepath=${1}
    rm $modulepath/build.xml
    rm $modulepath/test/ant-*
    rm $modulepath/package.json
    rm $modulepath/composer.json
    rm -R $modulepath/data/logs
    rm -R $modulepath/data/session
    rm -R $modulepath/data/cache
    rm -R $modulepath/data/DoctrineModule
    rm -R $modulepath/data/DoctrineORMModule
    rm -R $modulepath/data/migrations
    rm -R $modulepath/data/node_modules
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
    rm $modulepath/gulpfile.js
    rm $modulepath/data/config.json
    rm $modulepath/public/js/spec/end2end.conf.js
    rm $modulepath/public/js/spec/karma.conf.js
    rm $modulepath/test/phpmd.xml
    rm $modulepath/test/phpcs-docs.xml
    rm $modulepath/test/phpunit-benchmark.xml
    rm $modulepath/test/phpunit-coverage-benchmark.xml
    rm $modulepath/schema/module.json

}

#php public/index.php gear module-as-project create MyModule $base --type=web --force

#cd $modulepath && script/deploy-development.sh

#cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web

#clean $modulepath

#cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web

#exit 1

cd $modulepath && php public/index.php gear module upgrade MyModule $base --type=web --force

cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web

clean $modulepath

cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web

exit 1

cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=composer
cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=npm
cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=file
cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=dir
cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=ant
cd $modulepath && php public/index.php gear module upgrade MyModule $base --type=web --just=composer --force
cd $modulepath && php public/index.php gear module upgrade MyModule $base --type=web --just=npm --force
cd $modulepath && php public/index.php gear module upgrade MyModule $base --type=web --just=file --force
cd $modulepath && php public/index.php gear module upgrade MyModule $base --type=web --just=dir --force
cd $modulepath && php public/index.php gear module upgrade MyModule $base --type=web --just=ant --force

cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=composer
cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=npm
cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=file
cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=dir
cd $modulepath && php public/index.php gear module diagnostic MyModule $base --type=web --just=ant

cd $modulepath && ant

exit 1