#!/bin/bash

DIR=$( cd "$( dirname "$0" )" && pwd );

pkill -f startCrawler&
nohup sh $DIR/startCrawler.sh > $DIR/crawler-nohup.log &