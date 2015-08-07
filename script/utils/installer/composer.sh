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
		\"robmorgan/phinx\" : \"*\",
		\"doctrine/doctrine-module\" : \"0.8.*\",
		\"php\" : \">=5.5\",
		\"imagine/Imagine\" : \"dev-master\",
		\"zendframework/zendframework\" : \"~2.5\",
		\"rwoverdijk/assetmanager\" : \"1.4.*\",
		\"mauriciopiber/gear-json\" : \"0.1.*\",
		\"mauriciopiber/gear-email\" : \"0.1.*\",
		\"mauriciopiber/gear-base\" : \"0.1.*\",
		\"mauriciopiber/gear-backup\" : \"0.1.*\",
		\"mauriciopiber/gear\" : \"0.1.*\",
		\"mauriciopiber/gear-image\" : \"0.1.*\",
		\"mauriciopiber/gear-admin\" : \"0.1.*\",
		\"mauriciopiber/gear-acl\" : \"0.1.*\",
		\"mauriciopiber/gear-version\" : \"0.1.*\"
	},
	\"require-dev\" : {
		\"evandotpro/edp-superluminal\" : \"dev-master\",
		\"bjyoungblood/bjy-profiler\" : \"dev-master\",
		\"zendframework/zend-developer-tools\" : \"dev-master\",
		\"sebastian/phpcpd\" : \"*\",
		\"sebastian/phpdcd\" : \"*\",
		\"phpunit/phpunit\" : \"4.7.*\",
		\"mauriciopiber/codeception\" : \"2.1.6\",
		\"phploc/phploc\" : \"*\",
		\"squizlabs/php_codesniffer\" : \"1.*\",
		\"phpmd/phpmd\" : \"@stable\",
		\"pdepend/pdepend\" : \"2.0.3\",
		\"johnkary/phpunit-speedtrap\" : \"~1.0@dev\"
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
		}, {
			\"type\" : \"vcs\",
			\"url\" : \"git@github.com:mauriciopiber/Codeception.git\"
		}
	***REMOVED***
}" > $projectDir/composer.json
echo "[OK***REMOVED***"

sudo composer update

echo "Projeto instalado com composer $projectDir."
echo "[OK***REMOVED***"
