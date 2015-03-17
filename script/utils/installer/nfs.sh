#!/bin/bash
projectDir=${1}

cat /etc/exports | grep "$projectDir"



if[ "$?" == 1 ***REMOVED***; then
echo "Setting new Entry for file"
sudo chmod 777 /etc/exports
sudo echo "$projectDir *(rw,sync,no_subtree_check)"  >> /etc/exports
sudo service nfs-kernel-server restart
echo "Folder exported successful"
fi

echo "Projeto compartilhado com nfs-kernel-server"
echo -n "[OK***REMOVED***"
