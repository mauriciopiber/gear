#!/bin/bash
baseDir=${1}
projectDir=${2}
projectName=${3}

skeleton="https://github.com/zendframework/ZendSkeletonApplication.git"

function exclude()
{
	ls -l $1 &> /dev/null

	if [ "$?" == 0 ***REMOVED***; then
		rm -R $1
	fi

}

exclude $baseDir/ZendSkeletonApplication
exclude $projectDir


mkdir $projectDir

cd $baseDir
git clone $skeleton
mv $baseDir/ZendSkeletonApplication/* $projectName/
sudo rm  -r $baseDir/ZendSkeletonApplication

cd $projectDir

echo "Criando arquivo composer.json: "
echo "{
	\"name\" : \"mauriciopiber/$projectName\",
	\"description\" : \"Enter description later\",
	\"keywords\" : [
		\"framework\",
		\"zf2\",
		\"php\",
		\"gear\"
	***REMOVED***,
	\"homepage\" : \"http://$projectName.pibernetwork.com\",
	\"license\" : [
		\"BSD-3-Clause\"
	***REMOVED***,
	\"require\" : {
		\"mrclay/minify\" : \"2.2.*\",
		\"doctrine/doctrine-orm-module\" : \"0.8.*\",
		\"doctrine/doctrine-module\" : \"0.8.*\",		
		\"robmorgan/phinx\" : \"*\",
		\"php\" : \">=5.5\",
		\"zendframework/zendframework\" : \"~2.5.1\",
		
		\"zendframework/zend-mvc\" : \"~2.6.0\",		
		\"rwoverdijk/assetmanager\" : \"1.4.*\",
        \"mauriciopiber/gear-email\" : \"~0.2.0\",
		\"mauriciopiber/gear-base\" : \"~0.2.0\",
		\"mauriciopiber/gear-image\" : \"~0.2.0\",
		\"mauriciopiber/gear-acl\" : \"~0.2.0\",		
		\"mauriciopiber/gear-admin\" : \"0.2.20\"
	},
	\"require-dev\" : {
						
		\"mauriciopiber/gear-json\" : \"~0.2.0\",
		\"mauriciopiber/gear-jenkins\" : \"~0.2.0\",
		\"mauriciopiber/gear-version\" : \"~0.2.0\",		
		\"mauriciopiber/gear-deploy\" : \"~0.2.0\",				
		\"mauriciopiber/gear\" : \"~0.2.0\",	
		\"zendframework/zend-developer-tools\" : \"dev-master\",
		\"sebastian/phpcpd\" : \"*\",
		\"sebastian/phpdcd\" : \"*\",
		\"phpunit/phpunit\" : \"4.*\",
		\"codeception/codeception\" : \"2.1.*\",
		\"phploc/phploc\" : \"*\",
		\"squizlabs/php_codesniffer\" : \"2.*\",
		\"phpmd/phpmd\" : \"@stable\",
		\"pdepend/pdepend\" : \"2.0.3\",
		\"johnkary/phpunit-speedtrap\" : \"~1.0@dev\"
	},
	\"repositories\" : [
	    {
			\"type\" : \"composer\",
			\"url\" : \"https://mirror.pibernetwork.com\"
		},
        { \"packagist\" : false }
	***REMOVED***
}" > $projectDir/composer.json
echo "[OK***REMOVED***"

sudo composer update

echo "Projeto instalado com composer $projectDir."
echo "[OK***REMOVED***"
