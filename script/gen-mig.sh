#!/bin/bash

date +"%Y-%m-%d-%H-%M-%S"


max=10
for i in `seq 2 $max`
do
    date -d "$i seconds" +"%Y%m%d%H%M%S"
done



