<?php

namespace MusicBrainz;

/**
 * Represents a MusicBrainz Recording object
 *
 */
class Recording
{
    public $id;
    public $title;
    public $releases = array();

    private $data;

    public function __construct(array $recording)
    {
        $this->data = $recording;

        $this->id    = (string) $recording['id'];
        $this->title = (string) $recording['title'];
        $this->artistName = (string) $recording['artist-credit'][0]['artist']['name'];
        $this->album = (string) $recording['releases'][0]['title'];
        if (isset($recording['artist-credit'][0]['artist']['disambiguation'])) {
            $this->artistDisambiguation = (string) $recording['artist-credit'][0]['artist']['disambiguation'];
        }
        $this->releaseCount = count($recording['releases']);
        //  var_dump($recording['artist-credit'][0]['artist']['name']);
        // $this->artist = (string) $recording['artist-credit']['artist']['name'];
    }
}
