#!/bin/bash

#set -ex


function create
{
	project=${1}
	modules=${2}
	script=${3}
	
	echo "$project $script"
	
	
	#echo "$modules"
	IFS="|"
    params=($modules)
    for key in "${!params[@***REMOVED***}"; do 
   
        moduleParams=${params[$key***REMOVED***}
        
        #echo "$moduleParams"
        
        IFS=";"
        inputs=($moduleParams)
        
        format=""
        #echo "${!inputs[@***REMOVED***}"
        
        for key2 in "${!inputs[@***REMOVED***}"; do
        
            if [ "$format" != "" ***REMOVED***; then
            	format="$format "
            fi; 
           
            format="$format${inputs[$key2***REMOVED***}"
        
        done  

        createModule $format
    
   done

	#moduleParams=$(echo "$modules" | tr '|' "\n")
	
	#echo ${moduleParams[1***REMOVED***}
	
}

function createModule
{
    module=${1}
    type=${2}
    gearfile=${3}
    migration=${4}	
	
	echo "Criando módulo $module $type $gearfile $migration"
	
}

project="Projetin"

create "$project" "MyProjectModuleCli;cli;module-cli.yml"\
"|MyProjectModuleWeb;web;module-web.yml"\
"|MyProjectModuleMvc;web;module-mvc.yml;20160123222068_all_columns.php" \
/var/www

