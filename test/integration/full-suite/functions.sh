#!/bin/bash


function tearDown {

    ls -l $modulepath &> /dev/null
    
    if [ "${?}" != 0 ***REMOVED***; then
    
        echo "Module Not Created Yet"
        return
        
    fi;
    
    module=${1}
    modulepath=${2}


    ls -l $modulepath/vendor/autoload.php &> /dev/null
    
    if [ "${?}" == 0 ***REMOVED***; then
     
        cd $modulepath && php public/index.php gear git repository delete $module --force
        cd $modulepath && php public/index.php gear jenkins suite delete    
        
    fi;

    ls -l $modulepath/.git &> /dev/null
    
    if [ "${?}" == 0 ***REMOVED***; then
     
        sudo rm -R $modulepath/.git
        
    fi;
    
    ls -l $modulepath/schema &> /dev/null
    
    if [ "${?}" == 0 ***REMOVED***; then
     
        sudo rm -R $modulepath/schema
        
    fi;

    


}


function complete {

    module=${1}
    modulepath=${2}
    type=${3}
    
    if [ "$module" == "" ***REMOVED***; then
    
        exit 1
    
    fi
    
    if [ "$modulepath" == "" ***REMOVED***; then
    
        exit 1
    
    fi    

    cd $modulepath && php public/index.php gear git repository create $module
    cd $modulepath && php public/index.php gear git repository init
    cd $modulepath && php public/index.php gear jenkins suite create $type
    cd $modulepath && php public/index.php gear deploy build "Primeiro Build com sucesso $module $type"


}
