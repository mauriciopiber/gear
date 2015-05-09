#!/bin/bash

projectDir=${1}

mkdir $projectDir/data/logs
chmod 777 -R $projectDir/data/
mkdir $projectDir/public/upload
chmod 777 -R $projectDir/public/upload