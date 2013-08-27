<?php

namespace MusicBrainz;

use MusicBrainz\Album;
use MusicBrainz\Artist;

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
        $this->artist = new Artist($recording['artist-credit'][0]['artist']);
        if($recording['releases'][0]) {
            $this->album = new Album($recording['releases'][0]);
        }
        $this->releaseCount = count($recording['releases']);
    }
}
