
cd ${1}
sudo git add .
sudo git commit -am "${3}"
sudo git push origin master
sudo git tag -a "${2}" -m "${3}"
sudo git push origin master --tags