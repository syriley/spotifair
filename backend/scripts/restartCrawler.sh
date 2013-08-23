#!/bin/bash

DIR=$( cd "$( dirname "$0" )" && pwd );

echo 'Stopping'
sh $DIR/stopCrawler.sh 
echo 'Sleeping'
sleep 5 
echo 'Starting'
nohup sh $DIR/startCrawler.sh > $DIR/crawler-nohup.log &