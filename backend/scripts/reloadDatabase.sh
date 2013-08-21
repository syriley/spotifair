#!/bin/bash
DIR=$( cd "$( dirname "$0" )" && pwd );
pushd $DIR/../
./vendor/bin/doctrine orm:schema-tool:drop --force
./vendor/bin/doctrine orm:schema-tool:create
cd sql/schema
# echo 'creating schema'
# cat * | mysql -u root -plurpak83 wpio
echo 'adding data'
cd ../data
cat * | mysql -u spotifair -pspotifair spotifair
#echo `cat *`
popd