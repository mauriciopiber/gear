#!/bin/bash

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract.sh"

function Gear_CI_Jenkins_Check
{
    name=${1}
    basePath=${2}
    type=${3}

    cd $basePath
    
    #fake-composer gear-jenkins/ci
    #fake-composer gear-jenkins/src
	
	sudo php public/index.php gear jenkins suite create "module-$type"
	status=$?
	echo $status
}

function Gear_Git_Clone
{
	git clone git@bitbucket.org:mauriciopiber/${1}.git ${2}
}

function Gear_Git_Setup
{
    name=${1}
    basePath=${2}

    cd $basePath
    
    #fake-composer gear-deploy/src
    
    
    echo "repository create"
    sudo php public/index.php gear git repository create $name
    echo "repository init"
    sudo php public/index.php gear git repository init	
}

#function Gear_CI_Start_Repository
#{#
#	
#	
#}

function Gear_CI_Repository_Check
{
    name=${1}

    cd $(Gear_Util_GetGearPath)

	sudo php public/index.php gear git repository read $name &> /dev/null
	status=$?
	
	echo "$status"
}

function Gear_CI_SetUp
{
    name=${1}
    basePath=${2}
    type=${3}
    
    
    #@TODO REMOVE IT
    
    
    #END REMOVE

    cd $basePath
    
    #fake-composer gear-jenkins/ci
    #fake-composer gear-jenkins/src
    #fake-composer gear-deploy/src
    
    
    echo "repository create"
    sudo php public/index.php gear git repository create $name
    echo "repository init"
    sudo php public/index.php gear git repository init
    echo "jenkins create"
    sudo php public/index.php gear jenkins suite create $type
}

function Gear_CI_CopyJenkinsFile
{
	nameUrl=${1}
	location=${2}
    suite=${3} # 0 for module, 1 for project
    type=${4} # web or cli for module, "" for project	
	
	ciMock="$headersDir/../ci-mock"
	
	if [ "$suite" == 1 ***REMOVED*** && [ "$type" == "" ***REMOVED***; then
		
		jenkins="$(cat $ciMock/jenkins)"
        newFile=$(echo "$jenkins" | sed -e "s/#PROJECT/$nameUrl/g")
	    echo "$newFile" > $location/Jenkinsfile
        return		
    fi
   
    if [ "$nameUrl" == "pbr-controller-mvc" ***REMOVED***; then
   	
   	    jenkins="$(cat $ciMock/jenkins_controller_mvc)"
        newFile=$(echo "$jenkins" | sed -e "s/#MODULE/$nameUrl/g")
        echo "$newFile" > $location/Jenkinsfile
        return
   	
   	fi
   
    jenkins="$(cat $ciMock/jenkins_$type)"
    newFile=$(echo "$jenkins" | sed -e "s/#MODULE/$nameUrl/g")
    echo "$newFile" > $location/Jenkinsfile
	#exit 1
    return		
}


function Gear_CI_TearDown
{
	name=${1}
	basePath=${2}
    
    if [ -d "$basePath" ***REMOVED***; then
        cd $basePath 
        vendor/bin/unload-module BjyAuthorize
        php public/index.php gear git repository delete $name --force
        php public/index.php gear jenkins suite delete	
    fi
   
    
}

function Gear_Jenkins_Indexing
{
	cd ${2}
    url=$(Gear_Util_ToUrl "${1}")
    sudo php public/index.php gear jenkins job build "$url" --indexing	
}

function Gear_Git_Commit
{
	name=${1}
	basePath=${2}

	cd $basePath	    
    sudo php public/index.php gear deploy save "Build com sucesso $name" 	
}


function Gear_CI_Build
{
	name=${1}
	basePath=${2}

	cd $basePath	    
    sudo php public/index.php gear deploy save "Primeiro Build com sucesso $name" 
    #"$increment"
    url=$(Gear_Util_ToUrl "$name")
    sudo php public/index.php gear jenkins job build "$url" --indexing
    #sudo php public/index.php gear jenkins job build "$url" '' 'master'		
}
