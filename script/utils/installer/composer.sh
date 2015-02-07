#!/bin/bash
baseDir=${1}
projectDir=${2}
projectName=${3}


skeleton="https://github.com/zendframework/ZendSkeletonApplication.git"


if [ -f $baseDir/ZendSkeletonApplication ***REMOVED***;
then
    rm -R $baseDir/ZendSkeletonApplication
fi

if [ -f $projectDir ***REMOVED***;
then
    rm -R $projectDir
fi


mkdir $projectDir



cd $baseDir
git clone $skeleton
mv ZendSkeletonApplication/* $projectName/
cd $projectDir
chmod 777 -R $projectDir/data/
php composer.phar self-update

echo "Criando arquivo composer.json: "
echo "{
	\"name\" : \"mauriciopiber/$projectName\",
	\"description\" : \"Enter description later\",
	\"keywords\" : [
		\"framework\",
		\"zf2\",
		\"php\"
	***REMOVED***,
	\"homepage\" : \"http://$projectName.pibernetwork.com.br\",
	\"license\" : [
		\"BSD-3-Clause\"
	***REMOVED***,
	\"require\" : {
		\"doctrine/doctrine-orm-module\" : \"0.8.*\",
		\"robmorgan/phinx\" : \"*\",
		\"doctrine/doctrine-module\" : \"0.8.*\",
		\"evandotpro/edp-superluminal\" : \"dev-master\",
		\"php\" : \">=5.3.3\",
		\"zendframework/zendframework\" : \"2.3.*\",
		\"rwoverdijk/assetmanager\" : \"1.4.*\"
	},
	\"require-dev\" : {
		\"mauriciopiber/gear\" : \"dev-master\",
		\"sebastian/phpcpd\" : \"*\",
		\"sebastian/phpdcd\" : \"*\",
		\"phpunit/phpunit\" : \"4.3.*\",
		\"phploc/phploc\" : \"*\",
		\"squizlabs/php_codesniffer\" : \"1.*\",
		\"phpmd/phpmd\" : \"@stable\",
		\"doctrine/migrations\" : \"dev-master\",
		\"pdepend/pdepend\" : \"2.0.3\"
	},
	\"repositories\" : [{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear.git\"
		}
	***REMOVED***
}" > $projectDir/composer.json
echo "[OK***REMOVED***"


php composer.phar install

sudo rm  -r $baseDir/ZendSkeletonApplication

echo "Projeto instalado com composer $projectDir."
echo "[OK***REMOVED***"