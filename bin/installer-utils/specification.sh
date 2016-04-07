#!/bin/bash
projectDir=${1}
projectName=${2}
database=${3}
username=${4}
password=${5}

folderName="specifications"


cd $projectDir/data
mkdir $folderName
cd $folderName


echo "{
    \"development\": {
        \"dbname\": \"$database\",
        \"dbhost\" : \"localhost\",
        \"host\": \"$projectName.gear.dev\",
        \"dbms\": \"mysql\",
        \"username\": \"$username\",
        \"password\": \"$password\",
        \"environment\" : \"development\"
    },
    \"staging\": {
        \"dbname\": \"\",
        \"dbhost\" : \"\",
        \"host\": \"\",
        \"dbms\": \"\",
        \"username\": \"\",
        \"password\": \"\",
        \"environment\" : \"staging\"
    },
    \"production\": {
        \"dbname\": \"\",
        \"dbhost\" : \"\",
        \"dbms\": \"\",
        \"host\": \"\",
        \"username\": \"\",
        \"password\": \"\",
        \"environment\" : \"production\"
    },
    \"testing-stag\": {
        \"host\": \"\",
        \"dbname\" : \"\",
        \"dbms\" : \"\",
        \"environment\" : \"testing\"
    },
    \"testing-dev\": {
        \"host\": \"\",
        \"dbname\" : \"\",
        \"dbms\" : \"\",
        \"environment\" : \"testing\"
    }
}" > $projectDir/data/$folderName/$projectName.json
