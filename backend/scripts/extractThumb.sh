 #!/bin/bash
if [ $# -eq 0 ]
  then
    echo "usage extractThumb.sh videoFilename output"
fi
 FILENAME=$1
 OUTPUT=$2
 echo $FILENAME;

ffmpeg -y -i $FILENAME -f mp4 -vcodec libx264 -b:v 1000k -ab 192k -ac 2 -acodec libmp3lame -ar 44100 -async 1 $OUTPUT.mp4 
ffmpeg -y -i $FILENAME  -ar 44100 -b:v 1000k  -crf 10 -ab 128k -r 24 -s 640x360 $OUTPUT.webm

ffmpeg -y -i $FILENAME -vframes 1 -an -s 640x360 $OUTPUT.jpg

convert $OUTPUT.jpg -type Grayscale $OUTPUT-bw.jpg

