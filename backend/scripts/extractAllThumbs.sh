#!/bin/bash
DIR=$( cd "$( dirname "$0" )" && pwd );
pushd $DIR/../../assets/videos/originals
	for file in *.mov
	 do 
		name=${file%.*}
		echo processing $file $name;

		mkdir ../$name
		pushd ../$name
		$DIR/extractThumb.sh ../originals/$file $name
		popd
	done;
popd	