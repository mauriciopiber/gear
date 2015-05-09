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
		\"imagine/Imagine\" : \"dev-master\",
		\"zendframework/zendframework\" : \"2.3.*\",
		\"rwoverdijk/assetmanager\" : \"1.4.*\",
		\"mauriciopiber/gear-json\" : \"0.1.2\",
		\"mauriciopiber/gear-email\" : \"0.1.2\",
		\"mauriciopiber/gear-base\" : \"0.1.16\",
		\"mauriciopiber/gear-backup\" : \"0.1.4\",
		\"mauriciopiber/gear\" : \"0.1.78\",
		\"mauriciopiber/gear-image\" : \"0.1.37\",
		\"mauriciopiber/gear-admin\" : \"0.1.48\",
		\"mauriciopiber/gear-acl\" : \"0.1.3\",
		\"mauriciopiber/gear-version\" : \"0.1.6\"
	},
	\"require-dev\" : {
		\"bjyoungblood/bjy-profiler\" : \"dev-master\",
		\"zendframework/zend-developer-tools\" : \"dev-master\",
		\"sebastian/phpcpd\" : \"*\",
		\"sebastian/phpdcd\" : \"*\",
		\"phpunit/phpunit\" : \"4.5.*\",
		\"codeception/codeception\" : \"2.0.12\",
		\"phploc/phploc\" : \"*\",
		\"squizlabs/php_codesniffer\" : \"1.*\",
		\"phpmd/phpmd\" : \"@stable\",
		\"pdepend/pdepend\" : \"2.0.3\"
	},
	\"repositories\" : [
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear.git\"
		},
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear-version.git\"
		},
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear-acl.git\"
		},
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear-base.git\"
		},
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear-email.git\"
		},
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear-backup.git\"
		},
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear-admin.git\"
		},
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear-image.git\"
		},
		{
			\"type\" : \"vcs\",
			\"url\" : \"git@bitbucket.org:mauriciopiber/gear-json.git\"
		}
	***REMOVED***
}" > $projectDir/composer.json
echo "[OK***REMOVED***"


php composer.phar install

sudo rm  -r $baseDir/ZendSkeletonApplication

echo "Projeto instalado com composer $projectDir."
echo "[OK***REMOVED***"
