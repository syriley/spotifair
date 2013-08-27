<?php

namespace MusicBrainz;

/**
 * Represents a MusicBrainz album object
 *
 */
class Album
{
    public $id;
    public $status;
    public $name;

    private $data;

    public function __construct(array $album)
    {
        $this->data = $album;

        $this->id        = isset($album['id']) ? (string) $album['id'] : '';
        if(isset($album['release-group']['id'])){
            $this->id        = $album['release-group']['id'];
        }
        
        $this->status      = isset($status['type']) ? (string) $status['type'] : '';
        $this->title      = isset($album['title']) ? (string) $album['title'] : '';
    }
}
