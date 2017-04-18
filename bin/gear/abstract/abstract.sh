#!/bin/bash
# ABSTRACT CLI

set -ex

# 0 - usa o constructor do módulo/projeto criado, 1 - usa o constructor do Gear principal, para testes
useOwnConstructor="1"

# O padrão deve ser 0, só será 1 quando tiver debugando o próprio Gear.

function Gear_Util_GetBasePath 
{
    basepath="/var/www/gear-package"
    echo "$basepath"	
}


function Gear_Util_GetGearPath 
{
	echo  "$(Gear_Util_GetBasePath)/gear"
}

function Gear_Util_NotInArray
{
    local haystack=${1}[@***REMOVED***
    local needle=${2}
    for i in ${!haystack}; do
        if [[ ${i} == ${needle} ***REMOVED******REMOVED***; then
            return 1
        fi
    done
    return 0
}

function Gear_Util_CopyGearfile 
{
	scriptDir=${1}
	gearfile=${2}
	destination=${3}
	
	if [ -e "$scriptDir/$gearfile" ***REMOVED***; then
		
	    sudo cp "$scriptDir/$gearfile" "$destination"
	    return 0	
    fi

    if [ -e "$scriptDir/gearfiles/$gearfile" ***REMOVED***; then
		
	    sudo cp "$scriptDir/gearfiles/$gearfile" "$destination"
	    return 0	
    fi

    echo "Não foi encontrado o gearfile especificado"
    exit 1
}

function Gear_Util_CopyMigration
{
	scriptDir=${1}
	migration=${2}
	destination=${3}
	
	if [ -e "$scriptDir/$migration" ***REMOVED***; then
		
	    sudo cp "$scriptDir/$migration" "$destination/data/migrations"
	    return 0	
    fi

    if [ -e "$scriptDir/migrations/$migration" ***REMOVED***; then
		
	    sudo cp "$scriptDir/migrations/$migration" "$destination/data/migrations"
	    return 0	
    fi

    echo "Não foi possível encontrar a migrations esperada"
    exit 1   
}

function Gear_Util_PrepareForDb
{
	cd ${1}
	sudo vendor/bin/phinx migrate
	vendor/bin/unload-module BjyAuthorize	
	sudo php public/index.php gear database fix
}

function Gear_Util_GetStaging
{
	
    echo "stag01.pibernetwork.com"
}

function Gear_Util_GetProduction
{
    echo "pibernetwork.com"	
}

function Gear_Util_ToUrl
{
    echo $(sed -e 's/\([A-Z***REMOVED***\)/-\L\1/g' -e 's/^-//'  <<< "${1}")	
}
