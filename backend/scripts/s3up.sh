#!/bin/bash
DIR=$( cd "$( dirname "$0" )" && pwd );
s3cmd sync  --acl-public  $DIR/../../assets/ s3://musicjelly

# can use if we want?? --delete-removed
