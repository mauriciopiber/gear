#!/bin/bash
# ABSTRACT CLI

headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

source "$headersDir/abstract-module.sh"

function constructCli
{
	modulePath=${1}
	module=${2}
	basePath=${3}
	type=${4}
	
    cd $modulePath 
    sudo php public/index.php gear module construct $module $basePath
    ant phpcs phpcs-docs phpmd phpcpd unit	
}
