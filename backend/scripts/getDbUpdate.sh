#!/bin/bash
DIR=$( cd "$( dirname "$0" )" && pwd );
pushd $DIR/../
./vendor/bin/doctrine orm:schema-tool:update --dump-sql
popd