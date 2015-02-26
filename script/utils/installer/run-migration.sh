#!/bin/bash
projectDir=${1}
cd $projectDir
./vendor/bin/phinx migrate